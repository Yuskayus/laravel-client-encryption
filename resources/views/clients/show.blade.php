<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swipeable Tabs Example</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        /* Background berdasarkan data-tab */
.tab[data-tab="info"] {
    background-image: url('/images/Backround.svg');
    background-size: cover;
    background-position: center;
}

.tab[data-tab="contact"] {
    background-image: url('/image/contact.jpg');
    background-size: cover;
    background-position: center;
}

.tab[data-tab="email"] {
    background-image: url('/image/email.jpg');
    background-size: cover;
    background-position: center;
}

.tab[data-tab="profile"] {
    background-image: url('/image/profile.jpg');
    background-size: cover;
    background-position: center;
}
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

/* Kontainer utama swiper */
.swiper-container {
    width: 100%;
    height: 100vh; /* Ubah menjadi tinggi layar penuh */
    overflow: hidden; /* Mencegah halaman ter-scroll */
    display: flex; /* Pastikan kontainer mengikuti aturan flex */
    justify-content: center; /* Pusatkan konten */
}

/* Wrapper swiper */
.swiper-wrapper {
    display: flex;
    flex-direction: row;
    width: 100%;
    height: 100%; /* Pastikan wrapper mengisi seluruh tinggi kontainer */
}

/* Slide swiper */
.swiper-slide {
    display: flex; /* Flexbox untuk elemen di dalam slide */
    justify-content: center; /* Pusatkan konten secara horizontal */
    align-items: center; /* Pusatkan konten secara vertikal */
    text-align: center;
    position: relative;
    background-size: cover; /* Gambar memenuhi area */
    background-position: center; /* Pusatkan gambar */
    color: #fff;
    z-index: 0;
    height: 100%; /* Pastikan slide mengisi seluruh kontainer */
}

/* Konten teks di dalam slide */
.swiper-slide .tab-content {
    position: relative;
    z-index: 1;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    max-width: 80%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

/* Logo dalam slide */
.slide-logo {
    max-width: 100px;
    height: auto;
    margin-bottom: 20px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    object-fit: contain;
    flex-shrink: 0; /* Mencegah logo mengecil */
}

/* Background image */
.background-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

/* Konten dalam tab */
.tab-content {
    padding: 20px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    text-align: center;
}

/* Tombol share image */
.btn-share-image {
    margin-top: 20px;
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    box-sizing: border-box;
    display: inline-block;
}

/* Efek hover pada tombol */
.btn-share-image:hover {
    background-color: #218838;
    transform: translateY(-3px);
}

/* Responsif: Menyesuaikan ukuran tab content dan tombol pada perangkat kecil */
@media (max-width: 768px) {
    .tab-content {
        padding: 15px;
    }

    .btn-share-image {
        width: 100%;
        padding: 12px;
        font-size: 18px;
    }

    .slide-logo {
        max-height: 60px;
    }
}


    </style>
</head>
<body>

 <!-- Tabs -->
<div class="tabs">
    <div class="tab active" data-tab="info" data-image="Backround1.svg">A</div>
    <div class="tab" data-tab="contact" data-image="Backround2.svg">B</div>
    <div class="tab" data-tab="email" data-image="Backround3.svg">C</div>
    <div class="tab" data-tab="email1" data-image="Backround4.svg">D</div>
    <div class="tab" data-tab="email2"  data-image="Backround5.svg">E</div>
    <div class="tab" data-tab="email3" data-image="Backround6.svg">F</div>
    <div class="tab" data-tab="email4" data-image="Backround7.svg">G</div>
</div>
<!-- <img id="tab-image" src="/image/Backround1.svg" alt="Background Image" style="display: none;"> -->


<!-- Swiper Container untuk Konten -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <!-- Konten Tab A -->
        <div class="swiper-slide" id="info" >
        <img src="/images/Backround1.svg" alt="Background" class="background-image">
            <div class="tab-content">
            <img src="/images/Logo.svg" alt="Logo Slide 1" class="slide-logo" />
            @if($client)
                    <p><strong>Halo,</strong> {{ $client->ClientName }}</p>
                    <!-- <p><strong>Halo,</strong> {{ $client->ClientNID }}</p> -->
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
                <button class="btn-share-image" data-target="info">
                    Share as Image
                </button>

            </div>
        </div>
        <!-- Konten Tab B -->
        <div class="swiper-slide" id="contact">
        <img src="/images/Backround2.svg" alt="Background" class="background-image">

            <div class="tab-content">
            <img src="/images/Logo.svg" alt="Logo Slide 1" class="slide-logo" />

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
                <button class="btn-share-image" data-target="contact">
                    Share as Image
                </button>
            </div>
        </div>
        <!-- Konten Tab C -->
        <div class="swiper-slide" id="email">
        <img src="/images/Backround3.svg" alt="Background" class="background-image">

            <div class="tab-content">
            <img src="/images/Logo.svg" alt="Logo Slide 1" class="slide-logo" />

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
            <button class="btn-share-image" data-target="email">
                    Share as Image
            </button>
            </div>
        </div>
        <!-- Konten Tab D -->
        <div class="swiper-slide" id="email1">
        <img src="/images/Backround4.svg" alt="Background" class="background-image">

            <div class="tab-content">
            <img src="/images/Logo.svg" alt="Logo Slide 1" class="slide-logo" />

            <p>Perkembangan Aset<br/> dalam 2024</p>
                <p><strong>Loss</strong> {{ $client->loss_pct }}%</p>
                <p><strong>Nilai Investasi Awal </strong> Rp{{ $client->nia }}</p>
                <p><strong>Loss</strong> Rp{{ $client->pl }}</p>
                <p><strong>Nilai Investasi Sekarang</strong> Rp{{ $client->nis }}</p>
                <button class="btn-share-image" data-target="email1">
                    Share as Image
                </button>
            </div>
        </div>
        <!-- Konten Tab E -->
        <div class="swiper-slide" id="email2">
        <img src="/images/Backround5.svg" alt="Background" class="background-image">

            <div class="tab-content">
            <img src="/images/Logo.svg" alt="Logo Slide 1" class="slide-logo" />

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
                <button class="btn-share-image" data-target="email2">
                    Share as Image
                </button>
            </div>
        </div>
        <!-- Konten Tab F -->
        <div class="swiper-slide" id="email3">
        <img src="/images/Backround6.svg" alt="Background" class="background-image">

            <div class="tab-content">
            <img src="/images/Logo.svg" alt="Logo Slide 1" class="slide-logo" />

            <p>Saham paling cuan di 2024</p>

<!-- Menampilkan saham dengan profit terbesar -->
@if(isset($client->profit) && $client->profit)
   <p><strong>Saham (ID):</strong> {{ $client->profitStock }} (ID: {{ $client->profitStockId }})</p>
   <p><strong>Profit:</strong> Rp{{ number_format($client->profit, 2, ',', '.') }}</p>
@else
   <p><strong>Saham:</strong> Data tidak tersedia.</p>
@endif
<button class="btn-share-image" data-target="email3">
                    Share as Image
                </button>
            </div>
        </div>
        <!-- Konten Tab G -->
        <div class="swiper-slide" id="email4">
        <img src="/images/Backround7.svg" alt="Background" class="background-image">

            <div class="tab-content">
            <img src="/images/Logo.svg" alt="Logo Slide 1" class="slide-logo" />

            <p>Saham Paling Boncos di 2024</p>
                <!-- Menampilkan saham dengan kerugian terbesar -->
                @if(isset($client->loss) && $client->loss)
                    <p><strong>Saham (ID):</strong> {{ $client->lossStock }} (ID: {{ $client->lossStockId }})</p>
                    <p><strong>Loss:</strong> Rp{{ number_format($client->loss, 2, ',', '.') }}</p>
                @else
                    <p><strong>Saham:</strong> Data tidak tersedia.</p>
                @endif
                <button class="btn-share-image" data-target="email4">
                    Share as Image
                </button>
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


                // Ubah gambar berdasarkan data-image
                const newImage = currentTab.getAttribute('data-image');
                const tabImage = document.getElementById('tab-image');
                tabImage.src = newImage;
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

    swiper.on('slideChange', function () {
    const currentSlide = swiper.slides[swiper.activeIndex];
    const image = currentSlide.getAttribute('data-image');
    currentSlide.style.backgroundImage = `url('${image}')`;

    // Update tab active
    document.querySelector('.tab.active')?.classList.remove('active');
    const activeTab = document.querySelector(`.tab[data-tab="${currentSlide.id}"]`);
    activeTab?.classList.add('active');
});

//share social media
document.addEventListener("DOMContentLoaded", function () {
        const shareButtons = document.querySelectorAll(".btn-share-image");

        shareButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const targetId = this.getAttribute("data-target"); // Ambil ID elemen target
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    // Gunakan html2canvas untuk menangkap elemen
                    html2canvas(targetElement).then((canvas) => {
                        // Konversi canvas ke data URL
                        const imageData = canvas.toDataURL("image/png");

                        // Buat elemen link untuk mengunduh gambar
                        const link = document.createElement("a");
                        link.href = imageData;
                        link.download = "slide-share.png"; // Nama file yang akan diunduh
                        link.click();
                    });
                }
            });
        });
    });

</script>

</body>
</html>
