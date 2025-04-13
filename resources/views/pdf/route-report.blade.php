<!DOCTYPE html>
<html>
<head>
    <title>Route Report</title>
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

        td.trip-date {
            width: 100px;
        }

        td.driver-name {
            width: 100px;
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
    <h2>Route Report</h2>

    <table>
        <thead>
            <tr>
                <th>Tractor / Trailer</th>
                <th>Driver Name</th>
                <th class="trip-date">Trip Date</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routes as $route)
                <tr>
                    <td>{{ $route['license_plate'] ?? 'N/A' }}</td>
                    <td class="driver-name">{{ trim(($route['first_name'] ?? '') . ' ' . ($route['last_name'] ?? '')) }}</td>
                    <td class="trip-date">{{ $route['end_date'] ?? 'N/A' }}</td>
                    <td>{{ $route['location'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ \Carbon\Carbon::now('Asia/Manila')->format('F j, Y g:i A') }} (Asia/Manila)
    </div>
</body>
</html>

