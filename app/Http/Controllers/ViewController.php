<?php

namespace App\Http\Controllers;

use App\Models\Agricultural_product;
use App\Models\Market_price;

class ViewController extends Controller
{
    public function index()
    {
        // In your controller

        $products = Agricultural_product::with('market_price')->paginate(9);



        return view('dashboard.view.view', [
            'products' => $products,
            'marketPrices' => $products->pluck('market_price')->flatten()
        ]);

    }
}
