<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveAccess', 'list.currencies');

        $currenciesAll = Currency::get();

        return response()->json([
            'code' => 200,
            'status' => 'List Currencies',
            'currenciesAll' => $currenciesAll,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function currencyStore(Request $request)
    {

        try {
            DB::beginTransaction();

            $data = $request->only('name');

            $validator = Validator::make($data, [
                'name' => 'required|string|min:3|max:8|unique:currencies',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $currency = new Currency();

            $input = $this->currencyInput();
            $currency->fill($input)->save();

            DB::commit();
            return response()->json([
                'message' => 'Currency created successfully',
                'currency' => $currency,
            ], 201);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error no crated',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function currencyShow(Currency $currency)
    {
        if (!$currency) {
            return response()->json([
                'message' => 'Currency not found.'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'currency' => $currency,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function currencyUpdate(Request $request, Currency $currency)
    {
        try {
            DB::beginTransaction();

            $data = $request->only('name');

            $validator = Validator::make($data, [
                'name' => 'required|string|min:3|max:8|unique:currencies',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $input = $this->currencyInput();
            $currency->fill($input)->update();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Update currency success',
                'currency' => $currency,
            ], 200);
        } catch (\Throwable $exception) {

            DB::rollBack();
            return response()->json([
                'message' => 'Error no update',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function currencyDestroy(Currency $currency)
    {
        try {
            DB::beginTransaction();

            $currency->delete();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Currency delete',
            ], 200);

        } catch (\Throwable $exception) {

            DB::rollBack();
            return response()->json([
                'message' => 'Error no update',
            ], 500);

        }
    }

    protected function currencyInput(): array {
        return [
            "name" => request("name"),
        ];
    }
}
