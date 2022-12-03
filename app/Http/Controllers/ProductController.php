<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Helpers\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveAccess', 'list.products');

        $Products = Product::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'products' => $Products,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function planStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only('name', 'price', 'currency_id', 'image', 'status');

            $validator = Validator::make($data, [
                'name' => 'required|string|min:3|max:8|unique:currencies',
                'price'  => 'required',
                'currency_id'  => 'required',
                'image' => 'required',
                'status'  => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $product = new Product();

            $file = null;
            if ($request->hasFile('image')) {
                $file = Uploader::uploadFile('image', 'public/plans');
            }

            $input = $this->currencyInput($file);
            $product->fill($input)->save();

            DB::commit();

            return response()->json([
                'message' => 'Currency created successfully',
                'product' => $product,
            ], 201);

        } catch (\Throwable $exception) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error no crated',
                'error' => $exception
            ], 500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if (!$product) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'procu$product' => $product,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
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

            $input = $this->productInput();
            $product->fill($input)->update();

            DB::commit();

            return response()->json([
                'code' => 200,
                'status' => 'Update currency success',
                'product' => $product,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $product->delete();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Product delete',
            ], 200);

        } catch (\Throwable $exception) {

            DB::rollBack();
            return response()->json([
                'message' => 'Error no update',
            ], 500);

        }
    }

    protected function currencyInput(string $file = null): array {
        return [
            "name" => request("name"),
            "price" => request("price"),
            "currency_id" => request("currency_id"),
            "image" =>  $file,
            "status" => request("status"),
        ];
    }
}
