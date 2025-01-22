<!DOCTYPE html>
<html>
<head>
    <title>Clients List</title>
</head>
<body>
    <h1>Clients List</h1>
    <ul>
        @foreach ($clients as $client)
            <li>
                <a href="{{ route('clients.show', Crypt::encrypt($client->ClientNID)) }}">
                    {{ $client->ClientName }} ({{ $client->Email }})
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
