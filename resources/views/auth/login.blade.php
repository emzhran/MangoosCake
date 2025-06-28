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
        }

        /* Background overlay with cake image effect */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, 
                rgba(139, 69, 19, 0.1) 0%,
                rgba(218, 165, 32, 0.1) 25%,
                rgba(255, 99, 71, 0.1) 50%,
                rgba(210, 105, 30, 0.1) 75%,
                rgba(178, 34, 34, 0.1) 100%);
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
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            font-size: 28px;
            color: #8B4513;
            font-weight: 700;
            letter-spacing: -0.5px;
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
            margin-bottom: 30px;
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
            background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
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
            background: linear-gradient(135deg, #5D2F0A 0%, #8B4513 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 69, 19, 0.3);
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
            margin-top: 25px;
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

        /* Responsive design */
        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 30px 25px;
            }
            
            .login-title h2 {
                font-size: 28px;
            }
        }

        /* Floating cake elements */
        .cake-float {
            position: absolute;
            opacity: 0.1;
            pointer-events: none;
            z-index: 0;
        }

        .cake-1 {
            top: 10%;
            left: 10%;
            font-size: 60px;
            animation: float 15s ease-in-out infinite;
        }

        .cake-2 {
            top: 70%;
            right: 15%;
            font-size: 50px;
            animation: float 18s ease-in-out infinite reverse;
        }

        .cake-3 {
            bottom: 20%;
            left: 20%;
            font-size: 40px;
            animation: float 22s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <!-- Floating cake decorations -->
    <div class="cake-float cake-1">🍰</div>
    <div class="cake-float cake-2">🧁</div>
    <div class="cake-float cake-3">🎂</div>

    <div class="login-container">
        <div class="logo">
            <h1>MANGOOS.</h1>
        </div>
        
        <div class="login-title">
            <h2>Sign In</h2>
        </div>
        
        <div class="login-subtitle">
            Login to Your Account
        </div>

        <form method="POST" action="{{ route('login') }}">
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
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
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
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="forgot-password">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot Password ?</a>
                @endif
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>
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

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const formControls = document.querySelectorAll('.form-control');
            
            formControls.forEach(control => {
                control.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });
                
                control.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });

            // Add floating animation to login container
            const container = document.querySelector('.login-container');
            let mouseX = 0;
            let mouseY = 0;
            
            document.addEventListener('mousemove', function(e) {
                mouseX = (e.clientX / window.innerWidth - 0.5) * 20;
                mouseY = (e.clientY / window.innerHeight - 0.5) * 20;
                
                container.style.transform = `translate(${mouseX * 0.1}px, ${mouseY * 0.1}px)`;
            });
        });
    </script>
</body>
</html>