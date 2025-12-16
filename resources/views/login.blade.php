<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ArenaTime.id</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #FF6B35;
            --primary-light: #FF8E53;
            --secondary: #00A8E8;
            --accent: #FFD166;
            --success: #06D6A0;
            --error: #EF476F;
            --background: #F8FAFC;
            --surface: #FFFFFF;
            --surface-light: #F1F5F9;
            --text: #1E293B;
            --text-light: #64748B;
            --border: #E2E8F0;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            --glow: 0 0 30px rgba(255, 107, 53, 0.15);
        }

        body {
            font-family: 'Inter', sans-serif;
            background:
                linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(0, 168, 232, 0.1) 100%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" opacity="0.03"><path fill="%23FF6B35" d="M500,100 C700,100 900,200 900,400 C900,600 700,700 500,700 C300,700 100,600 100,400 C100,200 300,100 500,100 Z"/><circle fill="%2300A8E8" cx="300" cy="300" r="60"/><circle fill="%23FFD166" cx="700" cy="500" r="40"/><rect fill="%2306D6A0" x="200" y="600" width="120" height="20" rx="10"/></svg>'),
                #F8FAFC;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow-y: auto;
        }

        /* Sports Pattern Background */
        .sports-pattern {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
            opacity: 0.4;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(255, 107, 53, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 168, 232, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 209, 102, 0.1) 0%, transparent 50%),
                linear-gradient(45deg, transparent 48%, rgba(255, 107, 53, 0.05) 50%, transparent 52%),
                linear-gradient(-45deg, transparent 48%, rgba(0, 168, 232, 0.05) 50%, transparent 52%);
        }

        /* Animated Sports Icons */
        .sports-icons {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
        }

        .sport-icon {
            position: absolute;
            font-size: 24px;
            color: rgba(255, 107, 53, 0.15);
            animation: float 6s ease-in-out infinite;
        }

        .icon-tennis {
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }

        .icon-basketball {
            top: 25%;
            right: 15%;
            animation-delay: 1s;
            color: rgba(0, 168, 232, 0.15);
        }

        .icon-soccer {
            bottom: 20%;
            left: 20%;
            animation-delay: 2s;
            color: rgba(6, 214, 160, 0.15);
        }

        .icon-badminton {
            top: 60%;
            right: 25%;
            animation-delay: 3s;
            color: rgba(255, 209, 102, 0.15);
        }

        .icon-volleyball {
            bottom: 30%;
            right: 10%;
            animation-delay: 4s;
            color: rgba(239, 71, 111, 0.15);
        }

        .icon-running {
            top: 40%;
            left: 15%;
            animation-delay: 5s;
            color: rgba(255, 107, 53, 0.15);
        }

        /* Court Lines */
        .court-lines {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
        }

        .court-line {
            position: absolute;
            background: rgba(255, 107, 53, 0.08);
            border-radius: 2px;
        }

        .line-1 {
            width: 200px;
            height: 4px;
            top: 20%;
            left: 5%;
            transform: rotate(45deg);
        }

        .line-2 {
            width: 150px;
            height: 4px;
            bottom: 25%;
            right: 8%;
            transform: rotate(-45deg);
        }

        .line-3 {
            width: 4px;
            height: 120px;
            top: 35%;
            right: 20%;
        }

        .line-4 {
            width: 4px;
            height: 80px;
            bottom: 40%;
            left: 25%;
        }

        .login-container {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 10;
            margin: auto;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: var(--shadow), var(--glow);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15), 0 0 30px rgba(255, 107, 53, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, var(--surface) 0%, var(--surface-light) 100%);
            padding: 40px 35px 30px;
            text-align: center;
            position: relative;
            border-bottom: 1px solid var(--border);
        }

        .back-btn {
            position: absolute;
            left: 25px;
            top: 25px;
            background: var(--surface);
            border: 2px solid var(--border);
            color: var(--text);
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .back-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }

        .logo-text {
            font-size: 28px;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.5px;
        }

        .card-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 8px;
        }

        .card-header p {
            font-size: 15px;
            color: var(--text-light);
            font-weight: 400;
        }

        .card-body {
            padding: 40px 35px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            z-index: 2;
            transition: color 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px 16px 52px;
            border: 2px solid var(--border);
            border-radius: 14px;
            font-size: 15px;
            font-weight: 400;
            background: var(--surface);
            transition: all 0.3s ease;
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
            background: var(--surface);
        }

        .form-input::placeholder {
            color: var(--text-light);
        }

        .form-input:focus+.input-icon {
            color: var(--primary);
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary);
            background: rgba(255, 107, 53, 0.1);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0 30px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-checkbox {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
        }

        .remember-label {
            font-size: 14px;
            color: var(--text);
            font-weight: 500;
        }

        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--primary-light);
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(255, 107, 53, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: var(--text-light);
            font-size: 14px;
            font-weight: 500;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider span {
            padding: 0 20px;
        }

        .social-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .btn-social {
            padding: 14px;
            border: 2px solid var(--border);
            border-radius: 14px;
            background: var(--surface);
            color: var(--text);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-social:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-google:hover {
            border-color: #DB4437;
            color: #DB4437;
        }

        .btn-facebook:hover {
            border-color: #1877F2;
            color: #1877F2;
        }

        .register-link {
            text-align: center;
            font-size: 15px;
            color: var(--text-light);
            margin-top: 20px;
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: var(--primary-light);
        }

        .alert {
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid;
        }

        .alert-success {
            background: rgba(6, 214, 160, 0.1);
            color: var(--success);
            border-color: rgba(6, 214, 160, 0.3);
        }

        .alert-error {
            background: rgba(239, 71, 111, 0.1);
            color: var(--error);
            border-color: rgba(239, 71, 111, 0.3);
        }

        @media (max-width: 520px) {
            body {
                padding: 20px 15px;
                align-items: flex-start;
            }

            .login-container {
                max-width: 100%;
            }

            .card-header {
                padding: 30px 25px 25px;
            }

            .card-body {
                padding: 30px 25px;
            }

            .social-buttons {
                grid-template-columns: 1fr;
            }

            .logo-text {
                font-size: 24px;
            }

            .remember-forgot {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }

        /* Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>

<body>
    <!-- Sports Pattern Background -->
    <div class="sports-pattern"></div>

    <!-- Animated Sports Icons -->
    <div class="sports-icons">
        <i class="sport-icon icon-tennis fas fa-table-tennis"></i>
        <i class="sport-icon icon-basketball fas fa-basketball-ball"></i>
        <i class="sport-icon icon-soccer fas fa-futbol"></i>
        <i class="sport-icon icon-badminton fas fa-table-tennis"></i>
        <i class="sport-icon icon-volleyball fas fa-volleyball-ball"></i>
        <i class="sport-icon icon-running fas fa-running"></i>
    </div>

    <!-- Court Lines -->
    <div class="court-lines">
        <div class="court-line line-1"></div>
        <div class="court-line line-2"></div>
        <div class="court-line line-3"></div>
        <div class="court-line line-4"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <a class="back-btn" href="{{ Route('home') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-table-tennis"></i>
                    </div>
                    <div class="logo-text">ArenaTime.id</div>
                </div>
                <h1>Selamat Datang Kembali</h1>
                <p>Masuk ke arena olahraga favoritmu</p>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login.auth') }}">
                    @csrf

                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-trophy"></i>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::get('error'))
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" class="form-input" placeholder="Alamat email" required>
                        </div>
                        @error('name')
                            <div class="text-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password" class="form-input" id="password"
                                placeholder="Kata sandi" required>
                            <button type="button" class="password-toggle" id="passwordToggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="remember-forgot">
                        <div class="remember-me">
                            <input type="checkbox" class="remember-checkbox" id="rememberMe">
                            <label for="rememberMe" class="remember-label">Ingat saya</label>
                        </div>
                        <a href="#" class="forgot-link">Lupa kata sandi?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk ke Arena
                    </button>

                    <div class="register-link">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            if (document.referrer && document.referrer.includes(window.location.hostname)) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const passwordToggle = document.getElementById('passwordToggle');
            const passwordInput = document.getElementById('password');

            passwordToggle.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    goBack();
                }
            });

            // Add focus effects to form inputs
            const formInputs = document.querySelectorAll('.form-input');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
        });
    </script>
</body>

</html>
