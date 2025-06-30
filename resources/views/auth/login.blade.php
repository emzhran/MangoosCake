<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangoes - Sign In</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            background-image: url("{{ asset('assets/cake_bg.png') }}");
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background-color: #fcece5;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, 
                rgba(139, 69, 19, 0.05) 0%,
                rgba(218, 165, 32, 0.05) 25%,
                rgba(255, 99, 71, 0.05) 50%,
                rgba(210, 105, 30, 0.05) 75%,
                rgba(178, 34, 34, 0.05) 100%);
            background-size: 200px 200px;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(2deg); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            overflow: hidden;
        }

        .login-form-section {
            padding: 40px;
            flex-basis: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-image-section {
            flex-basis: 50%;
            background: #FFF8E1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .login-image-section img {
            display: block;
            width: 98%;
            height: 98%;
            /* object-fit: cover; */
            transition: transform 0.3s ease-in-out;
        }
        
       

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        /* === CSS UNTUK UKURAN LOGO DITAMBAHKAN DI SINI === */
        .logo img {
            height: 45px; /* Atur tinggi logo di sini */
            width: auto;  /* Biarkan lebar menyesuaikan agar tidak gepeng */
            max-width: 100%;
        }

        .login-title {
            text-align: center;
            margin-bottom: 10px;
        }

        .login-title h2 {
            font-size: 32px;
            color: #333;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-subtitle {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            background: #fff;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: #8B4513;
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }

        .form-control::placeholder {
            color: #999;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 25px;
        }

        .forgot-password a {
            color: #8B4513;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #5D2F0A;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #960000, #c00000);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(150, 0, 0, 0.3);
        }

        .signup-link {
            text-align: center;
            margin: 25px 0;
            color: #666;
            font-size: 14px;
        }

        .signup-link a {
            color: #8B4513;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            border: 1px solid #e1e5e9;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #666;
        }

        .social-btn:hover {
            background: #f8f9fa;
            border-color: #8B4513;
            color: #8B4513;
            transform: translateY(-2px);
        }

        .social-btn i {
            font-size: 18px;
        }
        
        .cake-float {
            position: absolute;
            opacity: 0.1;
            pointer-events: none;
            z-index: 0;
            font-size: 60px;
            animation: float 15s ease-in-out infinite;
        }

        .cake-1 { top: 10%; left: 10%; }
        .cake-2 { top: 70%; right: 15%; font-size: 50px; animation-direction: reverse; animation-duration: 18s; }
        .cake-3 { bottom: 20%; left: 20%; font-size: 40px; animation-duration: 22s; }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 400px;
                margin: 20px;
            }
            .login-image-section {
                display: none;
            }
            .login-form-section {
                flex-basis: 100%;
                padding: 30px 25px;
            }
            .login-title h2 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="cake-float cake-1">🍰</div>
    <div class="cake-float cake-2">🧁</div>
    <div class="cake-float cake-3">🎂</div>

    <div class="login-container">
        <div class="login-form-section">
            <div class="logo">
                <img src="{{ asset('assets/logo.png') }}" alt="Mangoos Logo">
            </div>
            
            <div class="login-title">
                <h2>Sign In</h2>
            </div>
            
            <div class="login-subtitle">
                Login to Your Account
            </div>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                
                <div class="form-group">
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="Email" 
                           required 
                           autocomplete="email" 
                           autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           name="password" 
                           placeholder="Password" 
                           required 
                           autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="forgot-password">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <div class="signup-link">
                Don't have an account? 
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Sign Up</a>
                @endif
            </div>

            <div class="social-login">
                <a href="#" class="social-btn">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-btn">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-btn">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="social-btn">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>
        
        <div class="login-image-section">
            <img src="{{ asset('assets/Maskgroup.png') }}" alt="Mango Illustration">
        </div>
    </div>
</body>
</html>