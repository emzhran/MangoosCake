<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan Anda</title>
    {{-- Anda bisa copy-paste link CSS dari dashboard customer atau gunakan cara lain --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Sesuaikan dengan path CSS Anda --}}
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        header { background-color: #fff; padding: 20px 40px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 24px; font-weight: bold; color: #333; }
        .nav-links a { margin-left: 20px; text-decoration: none; color: #555; }
        .container { max-width: 900px; margin: 40px auto; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .section-title { text-align: center; color: #333; margin-bottom: 30px; font-size: 28px; }
        .order-summary { display: flex; gap: 40px; margin-bottom: 30px; }
        .order-summary-image { flex: 1; text-align: center; }
        .order-summary-image img { width: 100%; max-width: 250px; height: auto; border-radius: 8px; }
        .order-summary-details { flex: 2; }
        .order-summary-details h1 { font-size: 32px; margin-top: 0; color: #333; }
        .order-summary-details p { font-size: 18px; margin: 10px 0; color: #666; }
        .order-summary-details .price { font-size: 24px; font-weight: bold; color: #e74c3c; }
        .order-item-detail { display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 5px; border-bottom: 1px dashed #eee; }
        .order-total { display: flex; justify-content: space-between; font-size: 22px; font-weight: bold; margin-top: 20px; padding-top: 20px; border-top: 2px solid #eee; }
        .btn-back-home { display: block; width: fit-content; margin: 40px auto 0; padding: 12px 25px; background-color: #007bff; color: white; text-decoration: none; border-radius: 8px; text-align: center; font-size: 18px; transition: background-color 0.3s ease; }
        .btn-back-home:hover { background-color: #0056b3; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 8px; font-size: 16px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <header>
        <div class="logo">Mangoos.</div>
        <nav class="nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/product') }}">Product</a>
            <a href="{{ url('/about-us') }}">About Us</a>
            <a href="{{ url('/contact') }}">Contact</a>
            @auth
                <a href="{{ url('/logout') }}">Logout</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
            @endauth
        </nav>
    </header>

    <div class="container">
        <h2 class="section-title">Pesanan Anda Berhasil!</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <p style="text-align: center; font-size: 18px; margin-bottom: 40px; color: #555;">
            Terima kasih telah berbelanja di Mangoos. Berikut detail pesanan Anda:
        </p>

        <div class="order-summary">
            <div class="order-summary-image">
                <img src="{{ asset('storage/' . $order->cake->gambar_kue) }}" alt="{{ $order->cake->nama_kue }}">
            </div>
            <div class="order-summary-details">
                <h1>{{ $order->cake->nama_kue }}</h1>
                <div class="order-item-detail">
                    <span>Harga Satuan:</span>
                    <span class="price">Rp {{ number_format($order->cake->harga_kue, 0, ',', '.') }}</span>
                </div>
                <div class="order-item-detail">
                    <span>Kuantitas:</span>
                    <span>{{ $order->jumlah_pemesanan }}</span>
                </div>
                <div class="order-item-detail">
                    <span>Tanggal Pesanan:</span>
                    <span>{{ \Carbon\Carbon::parse($order->tanggal_pemesanan)->translatedFormat('d M Y, H:i') }}</span>
                    </div>
                <div class="order-item-detail">
                    <span>Status Pesanan:</span>
                    <span style="text-transform: capitalize;">{{ $order->status }}</span>
                </div>
            </div>
        </div>

        <div class="order-total">
            <span>Total Pembayaran:</span>
            <span class="price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>

        <a href="{{ route('customer.dashboard') }}" class="btn-back-home">Kembali ke Beranda</a>
    </div>

    {{-- Footer bisa Anda @include jika sudah dibuat partial --}}
    <footer>
        {{-- ... Isi footer Anda ... --}}
        <p style="text-align: center; margin-top: 50px; color: #888;">&copy; {{ date('Y') }} Mangoos. All rights reserved.</p>
    </footer>
</body>
</html>