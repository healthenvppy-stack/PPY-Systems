<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPY Digital Platform</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

    <!-- TOP NAV -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="/logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </li>
        </ul>

        <form id="logout-form" action="/logout" method="POST" style="display:none;">
            @csrf
        </form>
    </nav>

    <!-- SIDEBAR -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="/dashboard" class="brand-link">
            <span class="brand-text font-weight-light">PPY Platform</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                    <div class="sidebar-zone zone-executive">
                        <div class="zone-title text-primary">ภาพรวม / Executive</div>
                        <a href="/dashboard" class="nav-link">
                            📊 ภาพรวมผู้บริหาร / Executive Dashboard
                        </a>
                    </div>

                    <div class="sidebar-zone zone-population">
                        <div class="zone-title text-success">ประชากร / Population</div>
                        <a href="{{ route('modules.population') }}" class="nav-link">
                            🏠 หน้าแรก / Home
                        </a>
                        <a href="{{ route('population.dashboard') }}" class="nav-link">
                            📈 แดชบอร์ด / Dashboard
                        </a>
                        <a href="{{ route('citizens.index') }}" class="nav-link">
                            👥 ข้อมูลประชาชน / Citizens
                        </a>
                        <a href="{{ route('households.index') }}" class="nav-link">
                            🏠 ข้อมูลครัวเรือน / Households
                        </a>
                        <a href="{{ route('data-quality.index') }}" class="nav-link">
                            🧹 คุณภาพข้อมูล / Data Quality
                        </a>
                    </div>

                    <div class="sidebar-zone zone-service">
                        <div class="zone-title" style="color:#b197fc;">บริการประชาชน / Services</div>
                        <a href="{{ route('service-cases.index') }}" class="nav-link">
                            📋 เคสบริการ / Service Cases
                        </a>
                        
                        <a href="{{ route('social-welfare.dashboard') }}" class="nav-link">
                            🤝 สวัสดิการ / Social Welfare
                        </a>
                        <a href="{{ route('public-health.dashboard') }}" class="nav-link">
                            🏥 สาธารณสุข / Public Health
                        </a>
                        <a href="#" class="nav-link">
                            🗺️ แผนที่ / GIS
                        </a>
                    </div>

                    <div class="sidebar-zone zone-management">
                        <div class="zone-title" style="color:#ffc078;">บริหารจัดการ / Management</div>
                        <a href="#" class="nav-link">
                            👤 บุคลากร / HR
                        </a>
                        <a href="#" class="nav-link">
                            🏢 ทรัพย์สิน / Assets
                        </a>
                        <a href="#" class="nav-link">
                            💰 การเงิน / Finance
                        </a>
                    </div>

                    <div class="sidebar-zone zone-system">
                        <div class="zone-title text-secondary">ระบบ / System</div>
                        <a href="#" class="nav-link">
                            ⚙️ ตั้งค่าระบบ / Settings
                        </a>
                    </div>
                </ul>
            </nav>
        </div>

    </aside>

    <!-- CONTENT -->
    <div class="content-wrapper p-3">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

</div>
@stack('scripts')
</body>
</html>