<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swipeable Tabs Example</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <style>
        /* Styling Tab dan Konten */
        .tabs {
            display: flex;
            justify-content: space-around;
            background-color: #f4f4f4;
            padding: 10px 0;
            border-bottom: 2px solid #ddd;
            overflow: hidden; /* Mencegah tab melebihi batas */
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

        .swiper-container {
            width: 100%;
            height: 400px; /* Batasi tinggi area swiper */
            overflow: hidden; /* Mencegah halaman ter-scroll */
        }

        .swiper-wrapper {
            display: flex;
            flex-direction: row;
        }

        .swiper-slide {
            height: 100%;  /* Sesuaikan tinggi agar tidak ada scroll */
            background: #f9f9f9;
            display: flex;
            justify-content: center; /* Horizontally center the content */
            align-items: center;     /* Vertically center the content */
            text-align: center;      /* Center the text inside the slide */
            padding: 20px;           /* Optional: untuk memberikan jarak pada teks */
            box-sizing: border-box;  /* Memastikan padding tidak mempengaruhi ukuran total */
        }

        .tab-content {
            padding: 20px;
            height: 100%;
            overflow: auto; /* Mencegah scroll horizontal */
        }

        .tab.active {
            background-color: #3498db;
            color: white;
        }
    </style>
</head>
<body>

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

<!-- Swiper Container untuk Konten -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <!-- Konten Tab A -->
        <div class="swiper-slide" id="info">
            <div class="tab-content">
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
        </div>
        <!-- Konten Tab B -->
        <div class="swiper-slide" id="contact">
            <div class="tab-content">
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
        </div>
        <!-- Konten Tab C -->
        <div class="swiper-slide" id="email">
            <div class="tab-content">
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
            </div>
        </div>
        <!-- Konten Tab D -->
        <div class="swiper-slide" id="email1">
            <div class="tab-content">
            <p>Perkembangan Aset<br/> dalam 2024</p>
                <p><strong>Loss</strong> {{ $client->loss_pct }}%</p>
                <p><strong>Nilai Investasi Awal </strong> Rp{{ $client->nia }}</p>
                <p><strong>Loss</strong> Rp{{ $client->pl }}</p>
                <p><strong>Nilai Investasi Sekarang</strong> Rp{{ $client->nis }}</p>
            </div>
        </div>
        <!-- Konten Tab E -->
        <div class="swiper-slide" id="email2">
            <div class="tab-content">
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
        </div>
        <!-- Konten Tab F -->
        <div class="swiper-slide" id="email3">
            <div class="tab-content">
            <p>Saham paling cuan di 2024</p>

<!-- Menampilkan saham dengan profit terbesar -->
@if(isset($client->profit) && $client->profit)
   <p><strong>Saham (ID):</strong> {{ $client->profitStock }} (ID: {{ $client->profitStockId }})</p>
   <p><strong>Profit:</strong> Rp{{ number_format($client->profit, 2, ',', '.') }}</p>
@else
   <p><strong>Saham:</strong> Data tidak tersedia.</p>
@endif
            </div>
        </div>
        <!-- Konten Tab G -->
        <div class="swiper-slide" id="email4">
            <div class="tab-content">
            <p>Saham Paling Boncos di 2024</p>
                <!-- Menampilkan saham dengan kerugian terbesar -->
                @if(isset($client->loss) && $client->loss)
                    <p><strong>Saham (ID):</strong> {{ $client->lossStock }} (ID: {{ $client->lossStockId }})</p>
                    <p><strong>Loss:</strong> Rp{{ number_format($client->loss, 2, ',', '.') }}</p>
                @else
                    <p><strong>Saham:</strong> Data tidak tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    // Inisialisasi Swiper
    const swiper = new Swiper('.swiper-container', {
        direction: 'horizontal',  // Navigasi horizontal
        loop: false,              // Tidak looping
        slidesPerView: 1,         // Menampilkan satu slide per tampilan
        spaceBetween: 0,          // Tidak ada jarak antar slide
        touchRatio: 1,            // Menyentuh untuk menggeser
        grabCursor: true,        // Menampilkan kursor geser
        noSwiping: false,        // Membolehkan swipe
        on: {
            slideChange: function () {
                // Menyembunyikan kelas 'active' pada tab sebelumnya
                const activeTab = document.querySelector('.tab.active');
                if (activeTab) activeTab.classList.remove('active');

                // Menambahkan kelas 'active' pada tab sesuai dengan slide yang aktif
                const currentSlide = swiper.slides[swiper.activeIndex];
                const currentTab = document.querySelector(`.tab[data-tab="${currentSlide.id}"]`);
                if (currentTab) currentTab.classList.add('active');
            }
        }
    });

    // Event listener untuk tab yang dipilih
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => {
            swiper.slideTo(index);  // Pindah ke slide yang sesuai saat tab diklik
        });
    });
</script>

</body>
</html>
