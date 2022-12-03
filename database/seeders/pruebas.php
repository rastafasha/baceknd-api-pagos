<?php

        // Currency number 13

use App\Models\Currency;

        $Currency = Currency::create([
            'name' => 'list.currencies',
            'description' => 'Puede listar los productos',
        ]);

        $Currencys_all[] = $Currency->id;

         // Currency number 14
        $Currency = Currency::create([
            'name' => 'show.currency',
            'description' => 'Puede ver el producto',
        ]);

        $Currencys_all[] = $Currency->id;
        
        // Currency number 15
        $Currency = Currency::create([
            'name' => 'edit.currency',
            'description' => 'Puede editar el producto',
        ]);

        $Currencys_all[] = $Currency->id;
        
        // Currency number 16
        $Currency = Currency::create([
            'name' => 'destroy.currency',
            'description' => 'Puede eliminar el producto',
        ]);

        $Currencys_all[] = $Currency->id;