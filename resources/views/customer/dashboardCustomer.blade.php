<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangoos Cake | Dashboard Pelanggan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--abu-muda);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

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

        .hero {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), 
                        url("{{ asset('assets/cake_bg.png') }}") center/cover;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 80px;
            color: var(--putih);
        }

        .hero-text {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: var(--border-radius);
            backdrop-filter: blur(10px);
        }

        .hero-text h1 {
            font-size: 48px;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .hero-text p {
            margin-bottom: 20px;
            font-size: 18px;
            opacity: 0.9;
        }

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
        }

        .btn-order:hover {
            background-color: #800000;
            transform: translateY(-2px);
        }

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

        .about {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .about img {
            width: 50%;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-medium);
        }

        .about-text {
            width: 50%;
        }

        .about-text p {
            font-size: 16px;
            color: var(--abu-gelap);
            text-align: justify;
        }

        .collections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-top: 30px;
        }

        .collection-item {
            background: var(--putih);
            border-radius: var(--border-radius);
            padding: 20px;
            text-align: center;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
        }

        .collection-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
        }

        .collection-item img {
            width: 100%;
            height: 200px; 
            object-fit: cover;
            border-radius: var(--border-radius);
            margin-bottom: 15px;
        }

        .collection-item .cake-name {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--abu-gelap);
            margin-bottom: 8px;
        }

        .collection-item .price {
            color: var(--merah-tua);
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .collection-item .order-button { 
            background: var(--merah-tua);
            border: none;
            color: var(--putih);
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
        }

        .collection-item .order-button:hover {
            background-color: #800000;
        }

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

        /* Responsive Design */
        @media (max-width: 768px) {
            section {
                padding: 40px 20px;
            }

            .hero {
                padding-left: 20px;
                text-align: center;
                justify-content: center;
            }

            .hero-text h1 {
                font-size: 32px;
            }

            .about {
                flex-direction: column;
            }

            .about img,
            .about-text {
                width: 100%;
            }

            nav {
                gap: 15px;
            }

            footer {
                padding: 30px 20px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Mangoos.</div>
        <nav>
            <a href="{{ route('customer.dashboard') }}">Home</a>
            <a href="#product-section">Product</a>
            <a href="#about">About Us</a>
            <a href="#contact">Contact</a>
            <a href="#"><i class="fas fa-user"></i></a> 
            <a href="#"><i class="fas fa-shopping-bag"></i></a>
            <form action="{{ route('logout') }}" method="POST" class="inline-block" style="margin-left: 24px;">
                @csrf
                <button type="submit" style="background: none; border: none; color: var(--hitam); cursor: pointer; font-size: 16px; font-weight: 500; transition: var(--transition); padding: 0;">Logout</button>
            </form>
        </nav>
    </header>

    <section class="hero" id="home">
        <div class="hero-text">
            <h1>
                <span style="color: var(--merah-tua);">BEST</span> Cake<br>
                <span style="color: var(--cream);">BEST PRICE</span>
            </h1>
            <p>Taste Our Newest Cake Freshly From The Oven.</p>
            <a href="#product-section" class="btn-order">Order Now</a> 
        </div>
    </section>

    <section id="about">
        <h2 class="section-title">About Us</h2>
        <div class="about">
            <img src="{{ asset('assets/about-us.png') }}" alt="About Mangoos Cake">
            <div class="about-text">
                <p>
                    Born from a love for baking and a desire to share moments of pure sweetness, 
                    Mangoos started as a dream in a cozy kitchen. We believe that every cake tells 
                    a story, and every bite should be a celebration of life's sweetest moments.
                </p>
                <p>
                    Our passionate bakers use only the finest ingredients, combining traditional 
                    techniques with modern flavors to create cakes that not only look stunning 
                    but taste absolutely divine. From custom birthday cakes to elegant wedding 
                    centerpieces, we're here to make your special occasions even sweeter.
                </p>
            </div>
        </div>
    </section>

    <section id="product-section">
        <h2 class="section-title">Our Collections</h2>
        <div class="collections">
            @forelse ($cakes as $cake)
            <div class="collection-item">
                <img src="{{ asset('storage/' . $cake->cake_image) }}" alt="{{ $cake->nama_kue }}">
                <div class="price">Rp {{ number_format($cake->harga_kue, 0, ',', '.') }}</div>
                <a href="{{ route('customer.dashboard', ['cake' => $cake->id]) }}" class="order-button">Order Now</a>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; color: var(--abu-gelap); font-size: 1.1em;">
                Maaf, belum ada kue yang tersedia di koleksi saat ini.
            </div>
            @endforelse
        </div>
    </section>

    <footer id="contact">
        <div class="footer-col">
            <div class="logo">Mangoos.</div>
            <p>Your Slice of <span style="color: var(--merah-tua);">Sweetness</span></p>
        </div>
        <div class="footer-col">
            <h4>Menu Kami</h4>
            <ul>
                <li>Home</li>
                <li>Product</li>
                <li>About Us</li>
                <li>Contact</li>
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
</body>
</html>