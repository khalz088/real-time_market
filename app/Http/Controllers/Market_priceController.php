<?php

namespace App\Http\Controllers;

use App\Models\Market_price;
use Illuminate\Http\Request;

class Market_priceController extends Controller
{
    public function index()
    {
        return Market_price::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'agricultural_product_id' => ['required', 'exists:agricultural_products'],
            'wholesale_price' => ['nullable', 'numeric'],
            'retail_price' => ['nullable', 'numeric'],
            'quantity_available' => ['required', 'numeric'],
            'is_organic' => ['boolean'],
            'price_trend' => ['nullable'],
            'price_change_percent' => ['required', 'numeric'],
        ]);

        return Market_price::create($data);
    }

    public function show(Market_price $market_price)
    {
        return $market_price;
    }

    public function update(Request $request, Market_price $market_price)
    {
        $data = $request->validate([
            'agricultural_product_id' => ['required', 'exists:agricultural_products'],
            'wholesale_price' => ['nullable', 'numeric'],
            'retail_price' => ['nullable', 'numeric'],
            'quantity_available' => ['required', 'numeric'],
            'is_organic' => ['boolean'],
            'price_trend' => ['nullable'],
            'price_change_percent' => ['required', 'numeric'],
        ]);

        $market_price->update($data);

        return $market_price;
    }

    public function destroy(Market_price $market_price)
    {
        $market_price->delete();

        return response()->json();
    }
}
