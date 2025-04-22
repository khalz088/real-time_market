<?php

namespace App\Http\Controllers;

use App\Models\Weather_data;
use Illuminate\Http\Request;

class Weather_dataController extends Controller
{
    public function index()
    {
        return Weather_data::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'forecast_date' => ['required', 'date'],
            'temperature_high' => ['nullable', 'numeric'],
            'temperature_low' => ['nullable', 'numeric'],
            'rainfall' => ['nullable', 'numeric'],
            'humidity' => ['nullable', 'integer'],
            'weather_condition' => ['nullable'],
        ]);

        return Weather_data::create($data);
    }

    public function show(Weather_data $weather_data)
    {
        return $weather_data;
    }

    public function update(Request $request, Weather_data $weather_data)
    {
        $data = $request->validate([
            'forecast_date' => ['required', 'date'],
            'temperature_high' => ['nullable', 'numeric'],
            'temperature_low' => ['nullable', 'numeric'],
            'rainfall' => ['nullable', 'numeric'],
            'humidity' => ['nullable', 'integer'],
            'weather_condition' => ['nullable'],
        ]);

        $weather_data->update($data);

        return $weather_data;
    }

    public function destroy(Weather_data $weather_data)
    {
        $weather_data->delete();

        return response()->json();
    }
}
