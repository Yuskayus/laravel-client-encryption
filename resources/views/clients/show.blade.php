<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Client - Instagram Story</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            /* background-color: #f4f7fa; */
            background-color: rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .story-container {
            display: flex;
            justify-content: center;
            /* background-color: rgba(0, 0, 0, 0.5); */
            align-items: center;
            height: 100vh;
            background-color: #333;
            position: relative;
            padding: 20px;
            box-sizing: border6-box;
        }

        .story-card {
            width: 300px;  /* Lebar kotak dikurangi */
            height: 500px;  /* Tinggi kotak dikurangi */
            /* background-color: rgba(0, 0, 0, 0.5); */
            background-color: white;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .story-card img {
            width: 100%;
            height: 70%;
            object-fit: cover;
            border-bottom: 5px solid #ddd;
        }

        .tabs {
            display: flex;
            justify-content: space-around;
            background-color: #f4f4f4;
            padding: 10px 0;
            border-bottom: 2px solid #ddd;
        }

        .tab {
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            color: #333;
            text-align: center;
            flex: 1;
        }

        .tab.active {
            background-color: #3498db;
            color: white;
            border-radius: 10px;
        }

        .tab-content {
            padding: 20px;
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .back-link {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 16px;
        }

        .back-link:hover {
            background-color: #2980b9;
        }

        /* Responsif */
        @media (max-width: 600px) {
            .story-card {
                width: 250px;
                height: 450px;
            }
        }
    </style>
</head>
<body>

    <div class="story-container">
        <div class="story-card">
            <!-- <img src="https://via.placeholder.com/300x200" alt="Client Picture"> -->

            <!-- Tabs -->
            <div class="tabs">
                <div class="tab active" data-tab="info">A</div>
                <div class="tab" data-tab="contact">B</div>
                <div class="tab" data-tab="email">C</div>
                <div class="tab" data-tab="email">D</div>
                <div class="tab" data-tab="email">E</div>
                <div class="tab" data-tab="email">F</div>
                <div class="tab" data-tab="email">G</div>
            </div>

            <!-- Tab Contents -->
            <div class="tab-content info active">
                <!-- <h1>Informasi Client</h1> -->
                @if($client)
                    <!-- <p><strong>ID:</strong> {{ $client->ClientID }}</p> -->
                    <p><strong>Halo,</strong> {{ $client->ClientName }}</p>
                    <p>            Terima kasih telah bersama kami<br />
                        di sepanjang 2024! Tahun lalu,
                        kita<br /> telah melewati berbagai momen<br /> menarik di dunia saham. Kami<br />
                        sangat menghargai kepercayaan<br /> Anda sebagai nasabah di Alpha<br />
                        Investasi. Semoga kita terus bisa<br /> tumbuh bersama dan meraih<br /> sukses
                        finansial di tahun-tahun<br /> mendatang.<br /><br />
                        Salam Hangat,<br /> Alpha Investasi
                    </p>
                @else
                    <p>Data client tidak ditemukan.</p>
                @endif
            </div>

            <div class="tab-content contact">
                <!-- <h1>Kontak Client</h1> -->
                @if($client)
                    <!-- <p><strong>ID:</strong> {{ $client->ClientID }}</p> -->
                    <p><strong>Halo,</strong> {{ $client->ClientName }}</p>
                    <p>Kamu bersama Alpha Sejak,</p>
                    <!-- <p>{{ $client->CreatedDate }}</p> -->
                    <p>{{ \Carbon\Carbon::parse($client->CreatedDate)->format('d-m-Y') }}</p>
                    <p>
                        Kamu telah bersama Alpha Investasi Selama hari. Wow!. Terima kasih telah
                        menjadi bagian dari perjalanan kami hingga saat ini.
                    </p>
                @else
                    <p>Data client tidak ditemukan.</p>
                @endif
            </div>

            <div class="tab-content email">
            <p>Frekuensi Transaksi<br/>kamu tahun 2024</p>
                @if($client)
                    <p><strong>ID:</strong> {{ $client->ClientID }}</p>
                    <p><strong>NID:</strong> {{ $client->ClientNID }}</p>
                    <p><strong>Email:</strong> {{ $client->Email }}</p>
                @else
                    <p>Data client tidak ditemukan.</p>
                @endif
            </div>

            <div class="tab-content email">
                <h1>Email Client1ppp</h1>
                @if($client)
                    <p><strong>ID:</strong> {{ $client->ClientID }}</p>
                    <p><strong>Email:</strong> {{ $client->Email }}</p>
                @else
                    <p>Data client tidak ditemukan.</p>
                @endif
            </div>

            <div class="tab-content email">
                <h1>Email Client1ppp</h1>
                @if($client)
                    <p><strong>ID:</strong> {{ $client->ClientID }}</p>
                    <p><strong>Email:</strong> {{ $client->Email }}</p>
                @else
                    <p>Data client tidak ditemukan.</p>
                @endif
            </div>

            <div class="tab-content email">
                <h1>Email Client1ppp</h1>
                @if($client)
                    <p><strong>ID:</strong> {{ $client->ClientID }}</p>
                    <p><strong>Email:</strong> {{ $client->Email }}</p>
                @else
                    <p>Data client tidak ditemukan.</p>
                @endif
            </div>

            <div class="tab-content email">
                <h1>Email Client1ppp</h1>
                @if($client)
                    <p><strong>ID:</strong> {{ $client->ClientID }}</p>
                    <p><strong>Email:</strong> {{ $client->Email }}</p>
                @else
                    <p>Data client tidak ditemukan.</p>
                @endif
            </div>

            <a href="{{ route('clients.index') }}" class="back-link">Kembali ke daftar</a>
        </div>
    </div>

    <script>
        // Script untuk menangani tab navigation
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Menghapus kelas 'active' dari semua tab dan tab-content
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));

                // Menambahkan kelas 'active' pada tab yang dipilih
                this.classList.add('active');
                const tabContent = document.querySelector('.' + this.getAttribute('data-tab'));
                tabContent.classList.add('active');
            });
        });
    </script>

</body>
</html>
