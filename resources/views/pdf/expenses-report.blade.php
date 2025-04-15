<!DOCTYPE html>
<html>
<head>
    <title>Expenses Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
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
            width: 120px;
        }

        td.amount {
            width: 100px;
        }

        td.category {
            width: 150px;
        }

        td.truck {
            width: 120px;
        }

        td.trailer {
            width: 120px;
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
    <h2>Expenses Report</h2>

    <table>
        <thead>
            <tr>
                <th class="number">#</th>
                <th class="truck">Truck</th>
                <th class="category">Category</th>
                <th class="amount">Amount</th>
                <th class="date">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $index => $expense)
                <tr>
                    <td class="number">{{ $index + 1 }}</td>
                    <td class="truck">{{ $expense['vehicle'] ?? $expense['trailer'] }}</td>
                    <td class="category">{{ $expense['category'] ?? 'N/A' }}</td>
                    <td class="amount">{{ number_format($expense['amount'] ?? 0, 2) }}</td>
                    <td class="date">{{ \Carbon\Carbon::parse($expense['expenses_date'])->format('F d, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ \Carbon\Carbon::now('Asia/Manila')->format('F j, Y g:i A') }} (Asia/Manila)
    </div>
</body>
</html>
