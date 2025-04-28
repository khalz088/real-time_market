<?php

namespace App\Http\Controllers;

use App\Models\Agricultural_product;
use App\Models\Category;
use App\Models\Market_price;
use Illuminate\Http\Request;

class Agricultural_productController extends Controller
{
    public function index()
    {
       $product =Agricultural_product::paginate(9);

       return view('dashboard.product.product',['product'=>$product]);
    }

    public function store(Request $request)
    {

        // Validate input data
        $data = $request->validate([
            'name' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required'],
            'measurement_unit' => ['required'],
            'seasonal' => ['boolean'],
        ]);

        $marketData = $request->validate([
            'wholesale_price' => ['nullable', 'numeric'],
            'retail_price' => ['required', 'numeric'], // Retail price is required for calculation
            'quantity_available' => ['required', 'numeric'],
            'is_organic' => ['boolean'],
        ]);

        // Get the latest market price for this product (if exists)
        $latestPrice = Market_price::where('agricultural_product_id', $request->category_id)
            ->latest()
            ->first();

        // Calculate price_change_percent and determine price_trend
        $priceChangePercent = 0;
        $priceTrend = 'stable'; // Default trend

        if ($latestPrice && $latestPrice->retail_price > 0) {
            $priceChangePercent = (($request->retail_price - $latestPrice->retail_price) / $latestPrice->retail_price) * 100;

            // Determine trend based on percentage change
            if ($priceChangePercent > 0) {
                $priceTrend = 'up'; // Increasing
            } elseif ($priceChangePercent < 0) {
                $priceTrend = 'down'; // Decreasing
            }
        }

        // Create the product
        $product = Agricultural_product::create([
            'user_id' => auth()->user()->id,
            ...$data]);

        // Create market price with auto-calculated fields
        Market_price::create([
            'agricultural_product_id' => $product->id,
            'price_change_percent' => round($priceChangePercent, 2),
            'price_trend' => $priceTrend,
            'user_id' => auth()->user()->id,
            ...$marketData // Include other validated fields
        ]);

        return redirect()->route('agricultural_product.index');
    }
    public function add()
    {
        $categories = Category::all();
        return view('dashboard.product.productadd', ['categories' => $categories]);
    }

    public function show(Agricultural_product $agricultural_product)
    {
        $category = Category::all();

        $market = $agricultural_product->market_price->first();

        return view('dashboard.product.productedit', ['categories' => $category, 'market' => $market , 'product' => $agricultural_product]);
    }

    public function update(Request $request, Agricultural_product $agricultural_product)
    {


        // Validate product data
        $data = $request->validate([
            'name' => ['required'],
            'category_id' => ['required', 'exists:categories,id'], // Added ,id
            'description' => ['required'],
            'measurement_unit' => ['required'],
            'seasonal' => ['boolean'],
        ]);

        // Validate market data (without calculated fields)
        $marketData = $request->validate([
            'wholesale_price' => ['nullable', 'numeric'],
            'retail_price' => ['nullable', 'numeric'],
            'quantity_available' => ['required', 'numeric'],
            'is_organic' => ['boolean'],
        ]);

        // Get the market price record
        $market = $agricultural_product->market_price->first();

        $priceChangePercent = $market->price_change_percent; // Keep existing if no change
        $priceTrend = $market->price_trend; // Keep existing if no change

        if ($request->has('retail_price') && $market->retail_price != $request->retail_price) {


            // Get previous price (excluding current record)
            $previousPrice = $agricultural_product->market_price->first();



            if ($previousPrice && $previousPrice->retail_price > 0) {
                $priceChangePercent = (($request->retail_price - $previousPrice->retail_price) / $previousPrice->retail_price) * 100;
                $priceTrend = $priceChangePercent > 0 ? 'up' : ($priceChangePercent < 0 ? 'down' : 'stable');

            }
        }


        // Update the product
        $agricultural_product->update($data);

        // Update the market price with calculated fields
        $market->update(array_merge($marketData, [
            'price_change_percent' => round($priceChangePercent, 2),
            'price_trend' => $priceTrend
        ]));

        return redirect()->route('agricultural_product.index');
    }

    public function destroy(Agricultural_product $agricultural_product)
    {
        $market =$agricultural_product->market_price->first();

        $market->delete();


        $agricultural_product->delete();

        return redirect()->route('agricultural_product.index');
    }
}
