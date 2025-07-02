<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangoes - Sign Up</title>
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
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            height: 45px;
            width: auto;
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
            margin-bottom: 15px;
        }

        /* --- PERUBAHAN DIMULAI DI SINI --- */

        .form-control {
            width: 100%;
            /* Padding diperkecil untuk mengurangi tinggi input */
            padding: 10px 14px; 
            border: 2px solid #e1e5e9;
            border-radius: 7px;
            /* Ukuran font diperkecil */
            font-size: 12px; 
            background: #fff;
            transition: all 0.3s ease;
            outline: none;
        }

        .btn-login {
            width: 100%;
            /* Padding diperkecil untuk mengurangi tinggi tombol */
            padding: 12px; 
            background: linear-gradient(135deg, #960000, #c00000);
            color: white;
            border: none;
            border-radius: 12px;
            /* Ukuran font diperkecil */
            font-size: 12px; 
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 8px;
        }

        /* --- PERUBAHAN SELESAI DI SINI --- */

        .form-control:focus {
            border-color: #8B4513;
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }
        
        .form-control::placeholder {
            color: #999;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(150, 0, 0, 0.3);
        }

        .signup-link {
            text-align: center;
            margin: 20px 0;
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

        .password-strength {
            margin-top: 5px;
            height: 3px;
            border-radius: 2px;
            background: #e1e5e9;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #dc3545; width: 33%; }
        .strength-medium { background: #ffc107; width: 66%; }
        .strength-strong { background: #28a745; width: 100%; }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 400px;
                margin: 20px;
                max-height: 95vh;
                overflow-y: auto;
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
                <img src="{{ asset('assets/logo1.png') }}" alt="Mangoos Logo">
            </div>
            
            <div class="login-title">
                <h2>Sign Up</h2>
            </div>
            
            <div class="login-subtitle">
                Create your account
            </div>

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                
                <div class="form-group">
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="Username" 
                           required 
                           autocomplete="name" 
                           autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="Email" 
                           required 
                           autocomplete="email">
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
                           autocomplete="new-password"
                           id="password">
                    <div class="password-strength" id="passwordStrength">
                        <div class="password-strength-bar" id="passwordStrengthBar"></div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" 
                           class="form-control" 
                           name="password_confirmation" 
                           placeholder="Confirm Password" 
                           required 
                           autocomplete="new-password">
                </div>

                <button type="submit" class="btn-login">
                    Register
                </button>
            </form>

            <div class="signup-link">
                Already have an account? 
                <a href="{{ route('login') }}">Sign In</a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('passwordStrengthBar');
            
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    const strength = checkPasswordStrength(password);
                    
                    strengthBar.className = 'password-strength-bar';
                    
                    if (password.length > 0) {
                        if (strength < 3) {
                            strengthBar.classList.add('strength-weak');
                        } else if (strength < 5) {
                            strengthBar.classList.add('strength-medium');
                        } else {
                            strengthBar.classList.add('strength-strong');
                        }
                    }
                });
            }

            function checkPasswordStrength(password) {
                let strength = 0;
                if (password.length >= 8) strength++;
                if (/[a-z]/.test(password)) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;
                return strength;
            }
        });
    </script>
</body>
</html>