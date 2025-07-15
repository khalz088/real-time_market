<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Market Price Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .period {
            font-size: 14px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .trend-up {
            color: green;
        }

        .trend-down {
            color: red;
        }

        .trend-neutral {
            color: gray;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: right;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="title">Market Price Report</div>
    <div class="period">
        From {{ \Carbon\Carbon::parse($start_date)->format('M d, Y') }}
        to {{ \Carbon\Carbon::parse($end_date)->format('M d, Y') }}
    </div>
</div>

<table>
    <thead>
    <tr>
        <th>Product</th>
        <th>Wholesale Price</th>
        <th>Retail Price</th>
        <th>Quantity</th>
        <th>Organic</th>
        <th>Price Trend</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($prices as $price)
        <tr>
            <td>{{ $price->agriculturalProduct->name ?? 'N/A' }}</td>
            <td>{{ number_format($price->wholesale_price, 2) }}</td>
            <td>{{ number_format($price->retail_price, 2) }}</td>
            <td>{{ $price->quantity_available }}</td>
            <td>{{ $price->is_organic ? 'Yes' : 'No' }}</td>
            <td class="trend-{{ $price->price_trend }}">
                {{ $price->price_trend }} ({{ $price->price_change_percent }}%)
            </td>
            <td>{{ $price->created_at->format('M d, Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

@if($prices->isEmpty())
    <div style="margin-top: 20px; text-align: center;">
        No market price data found for the selected date range.
    </div>
@endif

<div class="footer">
    Generated on {{ now()->format('M d, Y H:i') }}
</div>
</body>
</html>
