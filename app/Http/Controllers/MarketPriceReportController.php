<?php

namespace App\Http\Controllers;

use App\Models\Market_price;
use Illuminate\Http\Request;
use PDF;

class MarketPriceReportController extends Controller
{
    public function index()
    {
        return view('dashboard.report.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $prices = Market_price::with(['agriculturalProduct', 'user'])
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->orderBy('created_at', 'desc')
            ->get();

        if ($request->has('export') && $request->export == 'pdf') {
            $pdf = PDF::loadView('dashboard.report.pdf', [
                'prices' => $prices,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

            return $pdf->download('market-prices-report-' . now()->format('Y-m-d') . '.pdf');
        }

        return view('dashboard.report.result', [
            'prices' => $prices,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
    }
}
