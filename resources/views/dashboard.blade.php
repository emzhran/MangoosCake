<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangoos Cake | Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* CSS Variables */
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

        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--abu-muda);
            line-height: 1.6;
        }

        /* Header Styles */
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

        /* Hero Section */
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
        }

        .btn-order:hover {
            background-color: #800000;
            transform: translateY(-2px);
        }

        /* Section Styles */
        section {
            padding: 60px 80px;
            max-width: 1200px;
            margin: 0 auto;
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

        /* About Section */
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

        /* Category Cards */
        .category-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-top: 30px;
        }

        .category-card {
            background: var(--putih);
            padding: 20px;
            border-radius: var(--border-radius);
            text-align: center;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
        }

        .category-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: var(--border-radius);
            margin-bottom: 15px;
        }

        .category-card p {
            font-size: 18px;
            font-weight: 600;
            color: var(--abu-gelap);
        }

        /* Collections */
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

        .collection-item .price {
            color: var(--merah-tua);
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .collection-item button {
            background: var(--merah-tua);
            border: none;
            color: var(--putih);
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .collection-item button:hover {
            background-color: #800000;
        }

        /* Footer */
        footer {
            background-color: var(--putih);
            padding: 40px 80px;
            margin-top: 60px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            font-size: 14px;
            color: var(--abu-gelap);
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
    <!-- HEADER -->
    <header>
        <div class="logo">Mangoos.</div>
        <nav>
            <a href="#home">Home</a>
            <a href="#product">Product</a>
            <a href="#about">About Us</a>
            <a href="#contact">Contact</a>
            <a href="#profile"><i class="fas fa-user"></i></a>
            <a href="#cart"><i class="fas fa-shopping-bag"></i></a>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <section class="hero" id="home">
        <div class="hero-text">
            <h1>
                <span style="color: var(--merah-tua);">BEST</span> Cake<br>
                <span style="color: var(--cream);">BEST PRICE</span>
            </h1>
            <p>Taste Our Newest Cake Freshly From The Oven.</p>
            <button class="btn-order">Order Now</button>
        </div>
    </section>

    <!-- ABOUT US -->
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

    <!-- CATEGORIES -->
    <section id="product">
        <h2 class="section-title">Choose Your Favorite</h2>
        <div class="category-cards">
            <div class="category-card">
                <img src="{{ asset('assets/card-1.png') }}" alt="Cakes">
                <p>Cakes</p>
            </div>
            <div class="category-card">
                <img src="{{ asset('assets/card-2.png') }}" alt="Dry Cake">
                <p>Dry Cake</p>
            </div>
            <div class="category-card">
                <img src="{{ asset('assets/card-3.png') }}" alt="Cookies">
                <p>Cookies</p>
            </div>
        </div>
    </section>

    <!-- COLLECTIONS -->
    <section>
        <h2 class="section-title">Our Collections</h2>
        <div class="collections">
            <div class="collection-item">
                <img src="{{ asset('assets/c1.png') }}" alt="Cake">
                <div class="price">Rp 321.000</div>
                <button>Order Now</button>
            </div>
            <div class="collection-item">
                <img src="{{ asset('assets/c2.png') }}" alt="Cake">
                <div class="price">Rp 150.000</div>
                <button>Order Now</button>
            </div>
            <div class="collection-item">
                <img src="{{ asset('assets/c3.png') }}" alt="Cake">
                <div class="price">Rp 400.000</div>
                <button>Order Now</button>
            </div>
            <div class="collection-item">
                <img src="{{ asset('assets/c4.png') }}" alt="Croissant">
                <div class="price">Rp 400.000</div>
                <button>Order Now</button>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
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