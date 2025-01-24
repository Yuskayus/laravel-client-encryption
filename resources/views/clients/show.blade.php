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

        .stock-info {
        display: flex;
        align-items: center; /* Menjaga elemen berada dalam satu baris */
        background-color: #f4f4f4; /* Warna latar belakang */
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Efek bayangan */
    }

    .logo {
        flex-shrink: 0; /* Agar logo tidak mengecil */
        margin-right: 15px;
    }

    .logo-img {
        width: 50px; /* Ukuran logo */
        height: 50px;
        object-fit: contain;
    }

    .stock-details {
        display: flex;
        flex-direction: column; /* Menata StockID dan StockName vertikal */
    }

    .stock-details p {
        margin: 0; /* Menghilangkan margin default pada p */
        font-size: 14px;
    }

    .stock-details p strong {
        font-weight: bold;
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
                <div class="tab" data-tab="email1">D</div>
                <div class="tab" data-tab="email2">E</div>
                <div class="tab" data-tab="email3">F</div>
                <div class="tab" data-tab="email4">G</div>
            </div>

            <!-- Tab Contents -->
            <div class="tab-content info active">
                @if($client)
                    <p><strong>Halo,</strong> {{ $client->ClientName }}</p>
                    <p><strong>Halo,</strong> {{ $client->ClientNID }}</p>
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
                @if($client)
                    <p><strong>Halo,</strong> {{ $client->ClientName }}</p>
                    <p>Kamu bersama Alpha Sejak,</p>
                    <p>{{ \Carbon\Carbon::parse($client->CreatedDate)->format('d-m-Y') }}</p>
                    <p>
                        Kamu telah bersama Alpha Investasi Selama {{ $client->days_registered }} hari. Wow!. Terima kasih telah
                        menjadi bagian dari perjalanan kami hingga saat ini.
                    </p>
                @else
                    <p>Data client tidak ditemukan.</p>
                @endif
            </div>

            <div class="tab-content email">
            <p>Frekuensi Transaksi<br/>kamu tahun 2024</p>
            @if(isset($client->unique_transaction_days))
                <p>Jumlah Hari Transaksi Unik (2024): {{ $client->unique_transaction_days }}</p>
            @else
                <p>Data jumlah hari transaksi unik tidak tersedia.</p>
            @endif


            @if($client->last_transaction_date)
                <p>Tanggal Transaksi Terakhir: {{ $client->last_transaction_date }}</p>
            @else
                <p>Data tanggal transaksi terakhir tidak tersedia.</p>
            @endif

                <!-- @if($client)
                    <p><strong>Tanggal Transaksi Terakhir</strong> {{ $client->ClientID }}</p>

                @else
                    <p>Data client tidak ditemukan.</p>
                @endif -->
</div>



            <div class="tab-content email1">
                <p>Perkembangan Aset<br/> dalam 2024</p>
                <p><strong>Loss</strong> {{ $client->loss_pct }}%</p>
                <p><strong>Nilai Investasi Awal </strong> Rp{{ $client->nia }}</p>
                <p><strong>Loss</strong> Rp{{ $client->pl }}</p>
                <p><strong>Nilai Investasi Sekarang</strong> Rp{{ $client->nis }}</p>
                <!-- @if($client) -->
                <!-- <p><strong>Nilai Investasi Awal</strong> {{ number_format($client->percentage, 0) }}%</p> Menampilkan persentase tanpa desimal -->
                <!-- <p><strong>Nilai Investasi Awal</strong> {{ $client->ClientID }}</p> -->
                <!-- <p><strong>Loss</strong> {{ $client->total_value ?? 'Data tidak tersedia' }}</p> -->
                    <!-- <p><strong>Total Investasi Sekarang</strong> {{ $client->Email }}</p> -->
                <!-- @else -->
                    <!-- <p>Data client tidak ditemukan.</p> -->
                <!-- @endif -->
            </div>

            <div class="tab-content email2">
                <p>Saham favoritmu di<br/> 2024</p>
                @if($client->stock_data)
                <p>            Saham {{ $client->stock_data->StockID }} menjadi saham andalan<br />
                        kamu di 2024!,
                         Semoga dapat cuan banyak<br /> ya dari saham favorit kamu ini
                    </p>
                    <!-- <h3>Informasi Saham Teratas</h3> -->
                    <!-- <p><strong>StockNID:</strong> {{ $client->stock_data->StockNID }}</p> -->
                    <p><strong></strong> {{ $client->stock_data->StockID }}</p>
                    <p><strong></strong> {{ $client->stock_data->StockName }}</p>
                    <!-- <p><strong>Frequency:</strong> {{ $client->stock_data->Freq }}</p> -->
                @else
                    <p>Tidak ada data saham untuk ditampilkan.</p>
                @endif
            </div>

            <div class="tab-content email3">
                <p>Saham paling cuan di 2024</p>

                 <!-- Menampilkan saham dengan profit terbesar -->
                @if(isset($client->profit) && $client->profit)
                    <p><strong>Saham (ID):</strong> {{ $client->profitStock }} (ID: {{ $client->profitStockId }})</p>
                    <p><strong>Profit:</strong> Rp{{ number_format($client->profit, 2, ',', '.') }}</p>
                @else
                    <p><strong>Saham:</strong> Data tidak tersedia.</p>
                @endif
            </div>

            <div class="tab-content email4">
                <p>Saham Paling Boncos di 2024</p>
                <!-- Menampilkan saham dengan kerugian terbesar -->
                @if(isset($client->loss) && $client->loss)
                    <p><strong>Saham (ID):</strong> {{ $client->lossStock }} (ID: {{ $client->lossStockId }})</p>
                    <p><strong>Loss:</strong> Rp{{ number_format($client->loss, 2, ',', '.') }}</p>
                @else
                    <p><strong>Saham:</strong> Data tidak tersedia.</p>
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
