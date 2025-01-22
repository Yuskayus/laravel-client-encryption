<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Client</title>
</head>
<body>
    <h1>Detail Client</h1>

    @if($client)
        <p><strong>ID:</strong> {{ $client->ClientID }}</p>
        <p><strong>Nama:</strong> {{ $client->ClientName }}</p>
        <p><strong>Email:</strong> {{ $client->Email }}</p>
        <!-- Tambahkan atribut lain sesuai kolom yang tersedia -->
    @else
        <p>Data client tidak ditemukan.</p>
    @endif

    <a href="{{ route('clients.index') }}">Kembali ke daftar</a>
</body>
</html>
