<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
        }

        /* Sidebar utama */
        .sidebar {
            width: 230px;
            min-height: 100vh;
            background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 25px;
        }

        .sidebar h2 span {
            display: block;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.85);
        }

        .nav-links {
            flex-grow: 1;
        }

        .nav-item {
            display: block;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            color: rgba(255,255,255,0.95);
            text-decoration: none;
            transition: 0.2s;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.15);
            transform: translateX(2px);
        }

        .nav-item.active {
            background: #fff;
            color: #1e40af;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Konten utama */
        .content {
            margin-left: 250px;
            padding: 30px;
            background: #f9fafb;
            min-height: 100vh;
        }

        /* Tombol umum */
        .btn-blue {
            background: #2563eb;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: background 0.2s ease;
        }
        .btn-blue:hover {
            background: #1d4ed8;
        }

        /* Dropdown user */
        .user-menu {
            position: relative;
        }
        .user-menu-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: #fff;
            padding: 12px 16px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .user-menu-btn:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
        }
        .user-menu-dropdown {
            position: absolute;
            bottom: 60px;
            left: 0;
            right: 0;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            z-index: 999;
        }
        .user-menu-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .user-menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #374151;
            text-decoration: none;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
        }
        .user-menu-item:hover {
            background: #f9fafb;
            color: #2563eb;
        }
        .user-menu-item.logout {
            color: #ef4444;
        }
        .user-menu-item.logout:hover {
            background: #fee2e2;
            color: #dc2626;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div>
            <h2>SISTEM IKU 7 <span>Universitas Andalas</span></h2>
            <div class="nav-links">
                <a href="{{ route('dosen.dashboard') }}" class="block px-4 py-2 rounded hover:bg-brown-600">Dashboard</a>
                <a href="{{ route('klaim_metode.create') }}" class="block px-4 py-2 rounded hover:bg-brown-600">Klaim Metode</a>
            </div>
        </div>

        <div class="user-menu">
            <button class="user-menu-btn" onclick="toggleUserMenu()">
                <span>{{ Auth::user()->name ?? 'User' }}</span>
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div class="user-menu-dropdown" id="userMenuDropdown">
                <a href="" class="user-menu-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile
                </a>
                <a href="" class="user-menu-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    Setting
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="user-menu-item logout" style="border:none;background:none;width:100%;text-align:left;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script>
        function toggleUserMenu() {
            const dropdown = document.getElementById('userMenuDropdown');
            dropdown.classList.toggle('show');
        }

        document.addEventListener('click', function (e) {
            const menu = document.querySelector('.user-menu');
            if (!menu.contains(e.target)) {
                document.getElementById('userMenuDropdown').classList.remove('show');
            }
        });
    </script>
</body>
</html>
