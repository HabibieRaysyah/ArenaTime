<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arena Time - Tempat Booking Lapangan Olahraga Terbaik</title>
    {{-- Jquery Cdn --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.2.0/mdb.min.css" rel="stylesheet" />
    {{-- Icon --}}
    <link rel="shortcut icon" href="{{ asset('Logo/logo.png') }}">
    <style>
        :root {
            --primary-color: #3b71ca;
            --primary-dark: #2851a3;
            --secondary-color: #9e9e9e;
            --success-color: #14a44d;
            --danger-color: #dc4c64;
            --warning-color: #e4a11b;
            --info-color: #54b4d3;
            --light-color: #fbfbfb;
            --dark-color: #332d2d;
            --accent-color: #8B5CF6;
            --primary: #FF6B35;
            --primary-light: #FF8E53;
            --secondary: #00A8E8;
            --accent: #FFD166;
            --accent-light: #ffd676;
            --success: #06D6A0;
            --error: #EF476F;
            --background: #F8FAFC;
            --surface: #FFFFFF;
            --surface-light: #F1F5F9;
            --text: #1E293B;
            --text-light: #64748B;
            --border: #E2E8F0;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            --sidebar-width: 280px;
            --header-height: 70px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            line-height: 1.6;
        }

        /* Navbar Enhancement */
        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95) !important;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            font-weight: 500;
            position: relative;
            margin: 0 8px;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }


        /* User Menu */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
        }

        .user-menu:hover {
            background: var(--surface-light);
        }

        .user-menu.active {
            background: var(--surface-light);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: var(--text-light);
        }

        .user-menu i.fa-chevron-down {
            transition: transform 0.3s ease;
            color: var(--text-light);
        }

        .user-menu.active i.fa-chevron-down {
            transform: rotate(180deg);
        }

        /* Dropdown Menu */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            width: 230px;
            background: var(--surface);
            border-radius: 12px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            padding: 8px;
            margin-top: 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 20px;
            width: 16px;
            height: 16px;
            background: var(--surface);
            transform: rotate(45deg);
            border-left: 1px solid var(--border);
            border-top: 1px solid var(--border);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: var(--surface-light);
            color: var(--primary);
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            color: var(--text-light);
        }

        .dropdown-item:hover i {
            color: var(--primary);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--border);
            margin: 8px 0;
        }

        /* Notification Badge */
        .notification-badge {
            position: relative;
        }

        .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--error);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Demo Content */
        .demo-content {
            padding: 40px;
            text-align: center;
            color: var(--text-light);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 0 20px;
            }

            .user-info {
                display: none;
            }

            .dropdown-menu {
                width: 200px;
                right: -10px;
            }
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--dark-color), #1a1a1a);
            color: white;
            padding: 80px 0 30px;
        }

        .footer-brand {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff, #e3f2fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .footer-links h6 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
        }

        .footer-links h6::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        }

        .footer-links a {
            color: #b0b0b0;
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            margin-bottom: 12px;
        }

        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }

        .newsletter-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: white;
            padding: 12px 20px;
        }

        .newsletter-input::placeholder {
            color: #b0b0b0;
        }

        .newsletter-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border: none;
            border-radius: 10px;
            padding: 12px 25px;
            color: white;
            font-weight: 600;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-right: 15px;
        }

        .social-links a:hover {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            transform: translateY(-3px);
        }

        /* Animations */
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

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .carousel-item {
                height: 60vh;
                min-height: 400px;
            }

            .carousel-caption {
                bottom: 20%;
                margin-left: 5%;
            }

            .carousel-caption h2 {
                font-size: 2rem;
            }

            .carousel-caption p {
                font-size: 1rem;
            }

            .search-section {
                margin-top: -40px;
            }

            .search-card {
                border-radius: 15px;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }
    </style>
    @stack('style')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-table-tennis me-2"></i>ArenaTime
            </a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Lapangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                    @if (Auth::check() && Auth::user()->role == 'user')
                        <!-- User Menu -->
                        <div class="user-menu" id="userMenu">
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-info">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-role">{{ Auth::user()->role }}</div>
                            </div>
                            <i class="fas fa-chevron-down"></i>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu" id="dropdownMenu">
                                <a href="{{ route('profile',Auth::user()->id) }}" class="dropdown-item">
                                    <i class="fas fa-user"></i>
                                    <span>Profil Saya</span>
                                </a>
                                <div class="dropdown-item">
                                    <i class="fas fa-cog"></i>
                                    <span>Pengaturan</span>
                                </div>
                                <div class="dropdown-item">
                                    <i class="fas fa-bell"></i>
                                    <span>Notifikasi</span>
                                    <span class="badge" style="position: static; margin-left: auto;">3</span>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item">
                                    <i class="fas fa-moon"></i>
                                    <span>Mode Gelap</span>
                                    <div class="form-check form-switch" style="margin-left: auto;">
                                        <input class="form-check-input" type="checkbox" id="darkModeSwitch">
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item" style="color: var(--error);">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Keluar</span>
                                </a>
                            </div>
                        </div>
            </div>
        @else
            <li class="nav-item ms-2">
                <a class="btn btn-primary btn-rounded" href="{{ Route('login') }}"
                    style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); border: none;">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </a>
            </li>
            @endif

            </ul>
        </div>
        </div>
    </nav>

    <div>
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <i class="fas fa-table-tennis me-2"></i>ArenaTime
                    </div>
                    <p class="mb-4" style="color: #b0b0b0;">
                        Platform terbaik untuk mencari dan memesan lapangan olahraga. Temukan pengalaman berolahraga
                        yang menyenangkan dan mudah.
                    </p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h6>Tautan Cepat</h6>
                        <a href="#">Beranda</a>
                        <a href="#">Lapangan</a>
                        <a href="#">Tentang Kami</a>
                        <a href="#">Kontak</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h6>Kategori</h6>
                        <a href="#">Badminton</a>
                        <a href="#">Futsal</a>
                        <a href="#">Basket</a>
                        <a href="#">Tenis</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-links">
                        <h6>Newsletter</h6>
                        <p style="color: #b0b0b0;" class="mb-3">Dapatkan informasi terbaru tentang promo dan
                            lapangan baru.</p>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control newsletter-input" placeholder="Email Anda">
                            <button class="btn newsletter-btn" type="button">Berlangganan</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-5" style="border-color: #444;">
            <div class="text-center py-3" style="color: #b0b0b0;">
                © 2024 ArenaTime. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.2.0/mdb.umd.min.js"></script>
    <script>
        // Add scroll animation
        document.addEventListener('DOMContentLoaded', function() {
            // Navbar background on scroll
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 100) {
                    navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                    navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
                } else {
                    navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                    navbar.style.boxShadow = 'none';
                }
            });

            // Chip selection
            const chips = document.querySelectorAll('.chip');
            chips.forEach(chip => {
                chip.addEventListener('click', function() {
                    chips.forEach(c => c.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
    <script>
        // Dropdown functionality
        const userMenu = document.getElementById('userMenu');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Toggle dropdown
        userMenu.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
            userMenu.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
                userMenu.classList.remove('active');
            }
        });

        // Close dropdown when clicking on dropdown items (optional)
        const dropdownItems = document.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                // Don't close dropdown for toggle items
                if (!this.querySelector('.form-check-input')) {
                    dropdownMenu.classList.remove('show');
                    userMenu.classList.remove('active');
                }
            });
        });

        // Dark mode toggle functionality
        const darkModeSwitch = document.getElementById('darkModeSwitch');
        darkModeSwitch.addEventListener('change', function() {
            if (this.checked) {
                document.body.style.setProperty('--background', '#1E293B');
                document.body.style.setProperty('--surface', '#334155');
                document.body.style.setProperty('--surface-light', '#475569');
                document.body.style.setProperty('--text', '#F1F5F9');
                document.body.style.setProperty('--text-light', '#94A3B8');
                document.body.style.setProperty('--border', '#475569');
            } else {
                document.body.style.setProperty('--background', '#F8FAFC');
                document.body.style.setProperty('--surface', '#FFFFFF');
                document.body.style.setProperty('--surface-light', '#F1F5F9');
                document.body.style.setProperty('--text', '#1E293B');
                document.body.style.setProperty('--text-light', '#64748B');
                document.body.style.setProperty('--border', '#E2E8F0');
            }
        });



        // Keyboard support (ESC to close)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                dropdownMenu.classList.remove('show');
                userMenu.classList.remove('active');
            }
        });
    </script>
    @stack('script')
</body>

</html>
