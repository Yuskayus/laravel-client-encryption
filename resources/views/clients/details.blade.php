<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Client</title>
</head>
<body>
    <h1>Detail Data Client</h1>

    @if(isset($message))
        <p>{{ $message }}</p>
    @else
        <p><strong>Start Date:</strong> {{ $startDate }}</p>
        <p><strong>End Date:</strong> {{ $endDate }}</p>

        <table border="1">
            <thead>
                <tr>
                    <th>ClientNID</th>
                    <th>StockNID</th>
                    <th>PL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result->ClientNID }}</td>
                        <td>{{ $result->StockNID }}</td>
                        <td>{{ number_format($result->pl, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('clients.index') }}">Kembali ke daftar</a>
</body>
</html>
