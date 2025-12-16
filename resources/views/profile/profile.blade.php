<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - ArenaTime.id</title>
    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            --sidebar-width: 280px;
            --header-height: 70px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background);
            color: var(--text);
            overflow-x: hidden;
        }

        /* Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--surface) 0%, var(--surface-light) 100%);
            border-right: 1px solid var(--border);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid var(--border);
            background: var(--surface);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 800;
            color: var(--text);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-section {
            margin-bottom: 25px;
        }

        .menu-title {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0 20px 10px;
        }

        .menu-items {
            list-style: none;
        }

        .menu-item {
            margin-bottom: 5px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .menu-link:hover {
            background: var(--surface-light);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .menu-link.active {
            background: rgba(255, 107, 53, 0.1);
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 600;
        }

        .menu-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* Header */
        /* Header */
        .header {
            height: var(--header-height);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: relative;
            z-index: 100;
        }

        .header-left h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
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
            width: 220px;
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

        /* Content Area */
        .content {
            padding: 30px;
        }

        /* Profile Header */
        .profile-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            border-radius: 20px;
            padding: 40px;
            color: white;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .profile-header::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .profile-info {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: white;
            position: relative;
        }

        .avatar-edit {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 32px;
            height: 32px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            border: 2px solid white;
        }

        .profile-details h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .profile-details p {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        .profile-stats {
            display: flex;
            gap: 30px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            display: block;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.8;
        }

        /* Profile Content */
        .profile-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .profile-card {
            background: var(--surface);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow);
        }

        .card-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 25px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
        }

        .btn-edit {
            background: rgba(255, 107, 53, 0.1);
            color: var(--primary);
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-edit:hover {
            background: var(--primary);
            color: white;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: var(--surface);
            color: var(--text);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .form-control:disabled {
            background: var(--surface-light);
            color: var(--text-light);
            cursor: not-allowed;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Activity List */
        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px 0;
            border-bottom: 1px solid var(--border);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .activity-icon.booking {
            background: var(--primary);
        }

        .activity-icon.payment {
            background: var(--success);
        }

        .activity-icon.profile {
            background: var(--secondary);
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .activity-time {
            font-size: 12px;
            color: var(--text-light);
        }

        /* Badges */
        .badges-section {
            margin-top: 30px;
        }

        .badges-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 15px;
        }

        .badge-item {
            text-align: center;
            padding: 15px;
            background: var(--surface-light);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .badge-item:hover {
            transform: translateY(-5px);
            background: var(--surface);
            box-shadow: var(--shadow);
        }

        .badge-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: white;
            font-size: 20px;
        }

        .badge-name {
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .profile-content {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .profile-info {
                flex-direction: column;
                text-align: center;
            }

            .profile-stats {
                justify-content: center;
            }

            .profile-header {
                padding: 30px 20px;
            }
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--surface-light);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 2px;
        }
    </style>
    @stack('style')

</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-table-tennis"></i>
                    </div>
                    <div class="logo-text">ArenaTime.id</div>
                </div>
            </div>

            <nav class="sidebar-menu">
                <div class="menu-section">
                    <div class="menu-title">Akun Saya</div>
                    <ul class="menu-items">
                        <li class="menu-item">
                            <a href="{{ route('user.profile', Auth::user()->id) }}" class="menu-link active">
                                <i class="fas fa-user"></i>
                                <span>Profil Saya</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                <i class="fas fa-shield-alt"></i>
                                <span>Keamanan</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                <i class="fas fa-bell"></i>
                                <span>Notifikasi</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.booking-user.index') }}" class="menu-link">
                                <i class="fas fa-credit-card"></i>
                                <span>Booking</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                </div>
                <div class="header-right">
                    <!-- Notification Bell -->
                    <div class="notification-badge">
                        <i class="fas fa-bell" style="font-size: 20px; color: var(--text-light); cursor: pointer;"></i>
                        <span class="badge">3</span>
                    </div>

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
                            <a href="{{ route('user.profile',Auth::user()->id) }}" class="dropdown-item">
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
            </header>

            @yield('content')
        </main>
    </div>

    <script>
        // Edit mode toggle
        let editMode = {
            personalInfo: false,
            sportsPref: false
        };

        function toggleEdit(section) {
            editMode[section] = !editMode[section];
            const form = document.getElementById(section + 'Form');
            const inputs = form.querySelectorAll('input, select, textarea,button');

            inputs.forEach(input => {
                input.disabled = !editMode[section];
            });
        }

        // Avatar edit functionality
        document.querySelector('.avatar-edit').addEventListener('click', function() {
            alert('Fitur upload foto profil akan segera tersedia!');
        });

        // // Menu item active state
        // const menuItems = document.querySelectorAll('.menu-link');
        // menuItems.forEach(item => {
        //     item.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         menuItems.forEach(i => i.classList.remove('active'));
        //         this.classList.add('active');
        //     });
        // });

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
