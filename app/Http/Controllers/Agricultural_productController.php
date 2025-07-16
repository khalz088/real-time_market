<?php

namespace App\Http\Controllers;

use App\Models\Agricultural_product;
use App\Models\Category;
use App\Models\Market;
use App\Models\Market_price;
use Illuminate\Http\Request;

class Agricultural_productController extends Controller
{
    public function index()
    {
        $products = Agricultural_product::with(['category', 'market', 'market_price'])
            ->paginate(9);

        return view('dashboard.product.product', ['product' => $products]);
    }

    public function store(Request $request)
    {
        // Validate input data
        $data = $request->validate([
            'name' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'market_id' => ['required', 'exists:markets,id'],
            'description' => ['required'],
            'measurement_unit' => ['required'],
            'seasonal' => ['boolean'],
        ]);

        $marketData = $request->validate([
            'wholesale_price' => ['nullable', 'numeric'],
            'retail_price' => ['required', 'numeric'],
            'quantity_available' => ['required', 'numeric'],
            'is_organic' => ['boolean'],
        ]);

        // Get the latest market price for this product
        $latestPrice = Market_price::where('agricultural_product_id', $request->category_id)
            ->latest()
            ->first();

        // Calculate price change and trend
        $priceChangePercent = 0;
        $priceTrend = 'stable';

        if ($latestPrice && $latestPrice->retail_price > 0) {
            $priceChangePercent = (($request->retail_price - $latestPrice->retail_price) / $latestPrice->retail_price) * 100;
            $priceTrend = $priceChangePercent > 0 ? 'up' : ($priceChangePercent < 0 ? 'down' : 'stable');
        }

        // Create the product
        $product = Agricultural_product::create([
            'user_id' => auth()->id(),
            ...$data
        ]);

        // Create market price
        Market_price::create([
            'agricultural_product_id' => $product->id,
            'price_change_percent' => round($priceChangePercent, 2),
            'price_trend' => $priceTrend,
            'user_id' => auth()->id(),
            ...$marketData
        ]);

        return redirect()->route('agricultural_product.index');
    }

    public function add()
    {
        $categories = Category::all();
        $markets = Market::all();

        return view('dashboard.product.productadd', [
            'categories' => $categories,
            'markets' => $markets
        ]);
    }

    public function show(Agricultural_product $agricultural_product)
    {
        $categories = Category::all();
        $markets = Market::all();
        $marketPrice = $agricultural_product->market_price->first();

        return view('dashboard.product.productedit', [
            'categories' => $categories,
            'markets' => $markets,
            'market' => $marketPrice,
            'product' => $agricultural_product
        ]);
    }

    public function update(Request $request, Agricultural_product $agricultural_product)
    {
        // Validate product data
        $data = $request->validate([
            'name' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'market_id' => ['required', 'exists:markets,id'],
            'description' => ['required'],
            'measurement_unit' => ['required'],
            'seasonal' => ['boolean'],
        ]);

        // Validate market data
        $marketData = $request->validate([
            'wholesale_price' => ['nullable', 'numeric'],
            'retail_price' => ['nullable', 'numeric'],
            'quantity_available' => ['required', 'numeric'],
            'is_organic' => ['boolean'],
        ]);

        // Get the market price record
        $marketPrice = $agricultural_product->market_price->first();

        // Calculate price changes if retail price was modified
        $priceChangePercent = $marketPrice->price_change_percent;
        $priceTrend = $marketPrice->price_trend;

        if ($request->has('retail_price') && $marketPrice->retail_price != $request->retail_price) {
            $previousPrice = Market_price::where('agricultural_product_id', $agricultural_product->id)
                ->where('id', '!=', $marketPrice->id)
                ->latest()
                ->first();

            if ($previousPrice && $previousPrice->retail_price > 0) {
                $priceChangePercent = (($request->retail_price - $previousPrice->retail_price) / $previousPrice->retail_price) * 100;
                $priceTrend = $priceChangePercent > 0 ? 'up' : ($priceChangePercent < 0 ? 'down' : 'stable');
            }
        }

        // Update the product
        $agricultural_product->update($data);

        // Update the market price
        $marketPrice->update(array_merge($marketData, [
            'price_change_percent' => round($priceChangePercent, 2),
            'price_trend' => $priceTrend
        ]));

        return redirect()->route('agricultural_product.index');
    }

    public function destroy(Agricultural_product $agricultural_product)
    {
        $agricultural_product->market_price()->delete();
        $agricultural_product->delete();

        return redirect()->route('agricultural_product.index');
    }
}
