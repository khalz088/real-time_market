<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function (Request $request) {
    $wilaya = $request->get('wilaya', 'Mwanza');

    $response = Http::get('https://api.weatherapi.com/v1/current.json', [
        'key' => env('WEATHER_API_KEY'),
        'q' => $wilaya . ',Tanzania',
    ]);
    $weather = $response->json();



    return view('dashboard', ['weather' => $weather , 'wilaya' => $wilaya]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/market.php';
