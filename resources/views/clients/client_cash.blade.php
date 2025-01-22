<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Cash</title>
</head>
<body>
    <h1>Client Cash Details</h1>

    @if(count($result) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th>ClientNID</th>
                    <th>Total Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result as $row)
                    <tr>
                        <td>{{ $row->ClientNID }}</td>
                        <td>{{ $row->total_value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No data found.</p>
    @endif
</body>
</html>
