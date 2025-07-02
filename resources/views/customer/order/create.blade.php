<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order {{ $cake->nama_kue }}</title>
    {{-- Ini adalah link Font Awesome yang Anda gunakan di dashboard, bagus untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Variabel CSS (copy dari dashboard.blade.php) */
        :root {
            --merah-tua: #960000;
            --cream: #E3CC99;
            --putih: #FFFFFF;
            --abu-muda: #E6DCD0;
            --abu-gelap: #2A2929;
            --hitam: #000000;
            --shadow-light: 0 2px 4px rgba(0,0,0,0.1);
            --shadow-medium: 0 5px 15px rgba(0,0,0,0.1);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        /* Reset dan Gaya Dasar (copy dari dashboard.blade.php) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--abu-muda); /* Latar belakang abu-muda dari dashboard */
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header (copy dari dashboard.blade.php) */
        header {
            background-color: var(--putih);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 32px;
            box-shadow: var(--shadow-light);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-weight: bold;
            font-size: 24px;
            color: var(--merah-tua);
        }

        nav {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        nav a {
            text-decoration: none;
            color: var(--hitam);
            font-weight: 500;
            transition: var(--transition);
        }

        nav a:hover {
            color: var(--merah-tua);
        }

        /* Tombol Order (btn-order) - Pastikan konsisten */
        .btn-order {
            background-color: var(--merah-tua);
            color: var(--putih);
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: var(--transition);
            display: inline-block;
            text-decoration: none;
            text-align: center; /* Tambah ini agar teks di tombol tengah */
        }

        .btn-order:hover {
            background-color: #800000;
            transform: translateY(-2px);
        }

        /* Section utama */
        section {
            padding: 60px 80px;
            max-width: 1200px;
            margin: 0 auto;
            flex-grow: 1;
        }

        .section-title {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 40px;
            color: var(--abu-gelap);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: var(--merah-tua);
        }

        /* Gaya Khusus Halaman Order Create */
        .order-container {
            display: flex;
            gap: 40px;
            margin-top: 20px; /* Sedikit naik dari 40px */
            background: var(--putih); /* Warna putih dari dashboard */
            padding: 40px;
            border-radius: var(--border-radius); /* Menggunakan variabel */
            box-shadow: var(--shadow-medium); /* Efek bayangan yang lebih baik */
            align-items: flex-start; /* Agar detail tidak terlalu ke bawah jika gambar kecil */
        }

        .order-image {
            flex: 1; /* Memberikan proporsi 1 bagian */
            max-width: 350px; /* Batasi lebar gambar */
            min-width: 250px; /* Pastikan tidak terlalu kecil */
        }

        .order-image img {
            width: 100%;
            height: auto; /* Biarkan tinggi menyesuaikan proporsi */
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light); /* Tambah bayangan pada gambar */
        }

        .order-details {
            flex: 2; /* Memberikan proporsi 2 bagian */
            padding-left: 20px; /* Sedikit padding di kiri */
        }

        .order-details h1 {
            font-size: 36px; /* Ukuran font lebih besar */
            font-weight: bold;
            color: var(--abu-gelap); /* Warna teks abu gelap */
            margin-bottom: 15px;
        }

        .order-details .price-per-item {
            font-size: 26px; /* Ukuran font harga satuan */
            color: var(--merah-tua);
            margin-bottom: 25px;
            font-weight: 600;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 15px; /* Jarak antar elemen lebih besar */
            margin: 25px 0; /* Margin atas bawah */
            border: 1px solid #ccc;
            border-radius: 8px; /* Sudut lebih melengkung */
            width: fit-content; /* Lebar sesuai konten */
            overflow: hidden; /* Pastikan border radius diterapkan */
        }

        .quantity-btn {
            width: 45px; /* Tombol lebih lebar */
            height: 45px; /* Tombol lebih tinggi */
            border: none; /* Hilangkan border individu */
            background: var(--abu-muda); /* Warna latar belakang tombol */
            cursor: pointer;
            font-size: 22px; /* Ukuran font ikon +/- */
            font-weight: bold;
            color: var(--abu-gelap);
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .quantity-btn:hover {
            background-color: var(--cream);
            color: var(--merah-tua);
        }

        #quantity {
            width: 70px; /* Input kuantitas lebih lebar */
            text-align: center;
            font-size: 20px; /* Ukuran font input */
            border: none; /* Hilangkan border individu */
            padding: 10px;
            background-color: var(--putih);
            color: var(--abu-gelap);
            font-weight: 600;
        }

        hr {
            border: none;
            border-top: 1px solid #eee; /* Garis pemisah yang lebih halus */
            margin: 30px 0; /* Margin atas bawah */
        }

        .total-price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 30px; /* Jarak lebih besar sebelum tombol */
        }

        .total-price-label {
            font-size: 22px; /* Ukuran font label total */
            font-weight: bold;
            color: var(--abu-gelap);
        }

        #total-price {
            font-size: 32px; /* Ukuran font total harga */
            font-weight: bold;
            color: var(--merah-tua);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .order-container {
                flex-direction: column; /* Tumpuk ke bawah pada layar kecil */
                align-items: center;
            }
            .order-image {
                max-width: 80%; /* Gambar lebih lebar di mode tumpuk */
                min-width: unset;
                margin-bottom: 30px;
            }
            .order-details {
                padding-left: 0;
                text-align: center; /* Rata tengah teks detail */
            }
            .quantity-selector {
                margin: 25px auto; /* Pusatkan selector kuantitas */
            }
            .total-price-row {
                flex-direction: column; /* Tumpuk total harga dan label */
                gap: 10px;
            }
        }

        @media (max-width: 768px) {
            section {
                padding: 40px 20px;
            }
            header {
                padding: 10px 20px;
                flex-direction: column;
                gap: 10px;
            }
            nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }
            .order-container {
                padding: 20px;
            }
            .order-details h1 {
                font-size: 28px;
            }
            .order-details .price-per-item,
            .total-price-label {
                font-size: 20px;
            }
            #total-price {
                font-size: 28px;
            }
        }

        /* Footer (copy dari dashboard.blade.php) */
        footer {
            background-color: var(--putih);
            padding: 40px 80px;
            margin-top: 60px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            font-size: 14px;
            color: var(--abu-gelap);
            margin-top: auto;
        }

        footer h4 {
            margin-bottom: 15px;
            color: var(--merah-tua);
            font-size: 16px;
        }

        footer ul {
            list-style: none;
        }

        footer ul li {
            margin-bottom: 8px;
            transition: var(--transition);
        }

        footer ul li:hover {
            color: var(--merah-tua);
            cursor: pointer;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .social-icons a {
            color: var(--abu-gelap);
            font-size: 20px;
            transition: var(--transition);
        }

        .social-icons a:hover {
            color: var(--merah-tua);
            transform: scale(1.1);
        }

        .bottom-bar {
            text-align: center;
            padding: 20px;
            background-color: #f5f5f5;
            font-size: 12px;
            color: #777;
        }

    </style>
</head>
<body>
    <header>
        <div class="logo">Mangoos.</div>
        <nav>
            <a href="{{ route('customer.dashboard') }}">Home</a>
            {{-- Anda bisa menyesuaikan link-link ini agar sesuai dengan id section di dashboard atau rute lain --}}
            <a href="{{ route('customer.dashboard') }}#product-section">Product</a>
            <a href="{{ route('customer.dashboard') }}#about">About Us</a>
            <a href="{{ route('customer.dashboard') }}#contact">Contact</a>
            {{-- Ikon User dan Keranjang bisa ditambahkan di sini jika ada fungsionalitasnya --}}
            <a href="#"><i class="fas fa-user"></i></a> 
            <a href="#"><i class="fas fa-shopping-bag"></i></a>
            {{-- Form logout dari dashboard --}}
            <form action="{{ route('logout') }}" method="POST" class="inline-block" style="margin-left: 24px;">
                @csrf
                <button type="submit" style="background: none; border: none; color: var(--hitam); cursor: pointer; font-size: 16px; font-weight: 500; transition: var(--transition); padding: 0;">Logout</button>
            </form>
        </nav>
    </header>

    <section>
        <h2 class="section-title">Pesan Sekarang</h2>

        <form method="POST" action="{{ route('customer.order.store') }}">
            @csrf
            {{-- Simpan ID kue dan harga asli di input tersembunyi --}}
            <input type="hidden" name="cake_id" value="{{ $cake->id }}">
            <input type="hidden" id="base-price" value="{{ $cake->harga_kue }}">

            <div class="order-container">
                <div class="order-image">
                    <img src="{{ asset('storage/' . $cake->gambar_kue) }}" alt="{{ $cake->nama_kue }}">
                </div>

                <div class="order-details">
                    <h1>{{ $cake->nama_kue }}</h1>
                    <p class="price-per-item">Rp {{ number_format($cake->harga_kue, 0, ',', '.') }}</p>

                    <div class="quantity-selector">
                        <button type="button" id="btn-minus" class="quantity-btn">-</button>
                        <input type="text" id="quantity" name="quantity" value="1" readonly>
                        <button type="button" id="btn-plus" class="quantity-btn">+</button>
                    </div>

                    <hr>

                    <div class="total-price-row">
                        <span class="total-price-label">Total Harga:</span>
                        <span id="total-price">
                            Rp {{ number_format($cake->harga_kue, 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit" class="btn-order" style="width: 100%;">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </form>
    </section>

    <footer>
        <div class="footer-col">
            <div class="logo">Mangoos.</div>
            <p>Your Slice of <span style="color: var(--merah-tua);">Sweetness</span></p>
        </div>
        <div class="footer-col">
            <h4>Menu Kami</h4>
            <ul>
                <li><a href="{{ route('customer.dashboard') }}">Home</a></li>
                <li><a href="{{ route('customer.dashboard') }}#product-section">Product</a></li>
                <li><a href="{{ route('customer.dashboard') }}#about">About Us</a></li>
                <li><a href="{{ route('customer.dashboard') }}#contact">Contact</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Hubungi Kami</h4>
            <ul>
                <li>mangooscake@gmail.com</li>
                <li>+62 812-3456-7890</li>
                <li>Jl. Kenangan Manis No. 10, Yogyakarta</li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Ikuti Kami</h4>
            <div class="social-icons">
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <div class="bottom-bar">
        © 2025 Mangoos. All Rights Reserved.
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnMinus = document.getElementById('btn-minus');
        const btnPlus = document.getElementById('btn-plus');
        const quantityInput = document.getElementById('quantity');
        const totalPriceDisplay = document.getElementById('total-price');
        const basePrice = parseFloat(document.getElementById('base-price').value);

        function updateTotalPrice() {
            let quantity = parseInt(quantityInput.value);
            if (isNaN(quantity) || quantity < 1) { // Menambah isNaN check
                quantity = 1;
                quantityInput.value = 1;
            }
            const total = basePrice * quantity;
            totalPriceDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        btnMinus.addEventListener('click', function() {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
                updateTotalPrice();
            }
        });

        btnPlus.addEventListener('click', function() {
            let quantity = parseInt(quantityInput.value);
            quantityInput.value = quantity + 1;
            updateTotalPrice();
        });

        // Panggil saat halaman dimuat untuk memastikan total harga awal benar
        updateTotalPrice();
    });
</script>
</body>
</html>