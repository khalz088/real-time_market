<?php

namespace App\Http\Controllers;

use App\Models\Agricultural_product;
use Illuminate\Http\Request;

class Agricultural_productController extends Controller
{
    public function index()
    {
        return Agricultural_product::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'category_id' => ['required', 'exists:categories'],
            'description' => ['required'],
            'measurement_unit' => ['required'],
            'seasonal' => ['boolean'],
        ]);

        return Agricultural_product::create($data);
    }

    public function show(Agricultural_product $agricultural_product)
    {
        return $agricultural_product;
    }

    public function update(Request $request, Agricultural_product $agricultural_product)
    {
        $data = $request->validate([
            'name' => ['required'],
            'category_id' => ['required', 'exists:categories'],
            'description' => ['required'],
            'measurement_unit' => ['required'],
            'seasonal' => ['boolean'],
        ]);

        $agricultural_product->update($data);

        return $agricultural_product;
    }

    public function destroy(Agricultural_product $agricultural_product)
    {
        $agricultural_product->delete();

        return response()->json();
    }
}
