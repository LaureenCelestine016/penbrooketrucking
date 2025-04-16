<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Report</title>
    <style>
       * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px; /* you can adjust this as needed */
            color: #333;
        }

        .logo-header {
            text-align: left;
            margin-bottom: 28px;
            padding: 0;
            line-height: 0; /* removes vertical space caused by text baseline */
        }

        .logo-header img {
            max-width: 250px;
            height: auto;
            display: block; /* avoids inline spacing issues */
            margin-bottom: 28px;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #213555;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #213555;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td.date {
            width: 100px;
        }

        td.amount {
            width: 70px;
        }

        td.supplier {
            width: 120px;
        }

        td.item {
            width: 80px;
        }

        td.truck {
            width: 60px;
        }

        td.number {
            width: 10px;
        }


        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="logo-header">
        <img src="{{ public_path('Headerlogo.png') }}" alt="Company Logo" >
    </div>

    <h2 style="margin-top:32px">Maintenance Report</h2>

    <table>
        <thead>
            <tr>
                <th class="number">#</th>
                <th class="truck">Truck</th>
                <th class="item">Item</th>
                <th class="amount">Unit Price</th>
                <th class="amount">Total Cost</th>
                <th class="supplier">Supplier</th>
                <th class="date">Breakdown Date</th>
                <th class="date">Up Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maintenance as $index => $entry)
            <tr>
                <td class="number">{{ $index + 1 }}</td> <!-- Auto number -->
                <td class="truck">{{ $entry['vehicle'] ?? $entry['trailer'] }}</td>
                <td class="item">{{ $entry['item'] ?? 'N/A' }}</td>
                <td class="amount">{{ number_format($entry['price'] ?? 0, 2) }}</td>
                <td class="amount">{{ number_format($entry['total'] ?? 0, 2) }}</td>
                <td class="supplier">{{ $entry['supplier'] ?? 'N/A' }}</td>
                <td class="date">{{ \Carbon\Carbon::parse($entry['breakdown'])->format('F d, Y') }}</td>
                <td class="date">{{ \Carbon\Carbon::parse($entry['up'])->format('F d, Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ \Carbon\Carbon::now('Asia/Manila')->format('F j, Y g:i A') }} (Asia/Manila)
    </div>
</body>
</html>
