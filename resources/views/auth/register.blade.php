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

        .register-container {
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

        .register-title {
            text-align: center;
            margin-bottom: 10px;
        }

        .register-title h2 {
            font-size: 32px;
            color: #333;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .register-subtitle {
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

        .invalid-feedback {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #8B1538 0%, #B91C3C 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #5D0A20 0%, #8B1538 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 21, 56, 0.3);
        }

        .signin-link {
            text-align: center;
            margin: 25px 0;
            color: #666;
            font-size: 14px;
        }

        .signin-link a {
            color: #8B1538;
            text-decoration: none;
            font-weight: 600;
        }

        .signin-link a:hover {
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
            border-color: #8B1538;
            color: #8B1538;
            transform: translateY(-2px);
        }

        .social-btn i {
            font-size: 18px;
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .register-container {
                margin: 20px;
                padding: 30px 25px;
            }
            
            .register-title h2 {
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
            top: 15%;
            left: 8%;
            font-size: 70px;
            animation: float 16s ease-in-out infinite;
        }

        .cake-2 {
            top: 60%;
            right: 12%;
            font-size: 55px;
            animation: float 19s ease-in-out infinite reverse;
        }

        .cake-3 {
            bottom: 25%;
            left: 15%;
            font-size: 45px;
            animation: float 23s ease-in-out infinite;
        }

        .cake-4 {
            top: 30%;
            right: 25%;
            font-size: 35px;
            animation: float 17s ease-in-out infinite reverse;
        }

        /* Password strength indicator */
        .password-strength {
            margin-top: 5px;
            height: 3px;
            border-radius: 2px;
            background: #e1e5e9;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #dc3545; width: 33%; }
        .strength-medium { background: #ffc107; width: 66%; }
        .strength-strong { background: #28a745; width: 100%; }
    </style>
</head>
<body>
    <!-- Floating cake decorations -->
    <div class="cake-float cake-1">🍰</div>
    <div class="cake-float cake-2">🧁</div>
    <div class="cake-float cake-3">🎂</div>
    <div class="cake-float cake-4">🍪</div>

    <div class="register-container">
        <div class="logo">
            <h1>Mangoes.</h1>
        </div>
        
        <div class="register-title">
            <h2>Sign Up</h2>
        </div>
        
        <div class="register-subtitle">
            Create your account
        </div>

        <form method="POST" action="{{ route('register') }}">
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
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
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
                       autocomplete="new-password"
                       id="password">
                <div class="password-strength" id="passwordStrength">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                </div>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
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

            <button type="submit" class="btn-register">
                Register
            </button>
        </form>

        <div class="signin-link">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formControls = document.querySelectorAll('.form-control');
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('passwordStrengthBar');
            
            // Form control animations
            formControls.forEach(control => {
                control.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });
                
                control.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });

            // Password strength checker
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

            // Add floating animation to register container
            const container = document.querySelector('.register-container');
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