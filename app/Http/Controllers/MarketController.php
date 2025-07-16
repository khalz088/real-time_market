<?php

namespace App\Http\Controllers;

use App\Models\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        $markets = Market::paginate(10);
        return view('dashboard.market.market', [
            'markets' => $markets,
        ]);
    }

    public function add()
    {
        return view('dashboard.market.marketadd');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        Market::create($data);

        return redirect()->route('market.index');

    }

    public function show(Market $market)
    {
        return view('dashboard.market.marketedit', [
            "market" => $market
        ]);
    }

    public function update(Request $request, Market $market)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        $market->update($data);

        return redirect()->route('market.index');
    }

    public function destroy(Market $market)
    {
        $market->delete();

        return redirect()->route('market.index');
    }
}
