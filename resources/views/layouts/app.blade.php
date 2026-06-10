<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/foto logo.png') }}">
    <title>@yield('title', 'Gym Membership') - GYM Membership</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root{

        --primary-color:#0f766e;
        --primary-hover:#115e59;

        --sidebar-bg:#111827;
        --sidebar-hover:#1f2937;

        --body-bg:#f8fafc;

        --card-bg:#ffffff;

        --text-primary:#111827;
        --text-secondary:#6b7280;

        --border-color:#e5e7eb;

        }
        
        body{
        font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
        background:#f8fafc;
        color:#111827;

        }
        
        /* Sidebar */
        .sidebar{

        width:260px;
        min-height:100vh;

        background:linear-gradient(
            180deg,
            #111827 0%,
            #0f172a 100%
        );

        border-right:1px solid rgba(255,255,255,.08);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            transition: all 0.3s ease;
        }
        
        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }


        .sidebar-brand img{

        width:46px;
        height:46px;

        border-radius:12px;

        background:white;

        padding:6px;

        }
        
        .sidebar-brand h4 {
            color: #fff;
            margin: 0;
            font-weight: 700;
        }
        
        .sidebar-brand span {
            color: #60a5fa;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .sidebar-menu .nav-item {
            margin: 0.25rem 0.75rem;
        }
        
        .sidebar-menu .nav-link {
            color: #94a3b8;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s ease;
        }
        
        .sidebar-menu .nav-link:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }
        
        .sidebar-menu .nav-link.active{

        background:rgba(15,118,110,.15);

        color:#5eead4;

        border-left:4px solid #14b8a6;

        border-radius:10px;

        }
        
        .sidebar-menu .nav-link i {
            font-size: 1.2rem;
        }
        
        .sidebar-divider {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin: 1rem 0.75rem;
        }
        
        .sidebar-label {
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.5rem 1.5rem;
            margin-top: 0.5rem;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }
        
        /* Top Navbar */
        .top-navbar{

        display:flex;
        align-items:center;
        justify-content:flex-end;

        height:72px;

        padding:0 24px;

        background:#ffffff;

        border-bottom:1px solid #e5e7eb;

        position:sticky;
        top:0;
        z-index:50;

        }


        
        .user-dropdown{

        display:flex;
        align-items:center;
        gap:12px;

        padding:8px 14px;

        border-radius:12px;

        transition:.2s;

        }

        .user-dropdown:hover{

            background:#f8fafc;

        }

        .user-avatar{

            width:42px;
            height:42px;

            border-radius:50%;

            background:#0f766e;

            color:white;

            display:flex;
            align-items:center;
            justify-content:center;

            font-weight:700;

        }

        .user-info .name{

            font-size:14px;
            font-weight:600;

            color:#111827;

        }

        .user-info .role{

            font-size:12px;

            color:#6b7280;

        }
        
        /* Page Content */
        .page-content {
            padding: 1.5rem;
        }
        
        .page-header {
            margin-bottom: 1.5rem;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        
        .page-subtitle {
            color: #64748b;
            margin: 0;
        }
        
        /* Cards */
        .card{

        border:1px solid #e5e7eb;

        border-radius:16px;

        box-shadow:
            0 4px 12px rgba(0,0,0,.04);

        transition:.25s;

        }
        .card:hover{

            transform:translateY(-2px);

        }
        
        .card-header {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.25rem;
            font-weight: 600;
        }
        
        /* Stat Cards */
        .stat-card{

        background:white;

        padding:24px;

        border-radius:16px;

        border:1px solid #e5e7eb;

        }
        
        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .stat-icon.primary {
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
        }
        
        .stat-icon.success {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }
        
        .stat-icon.warning {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }
        
        .stat-icon.info {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }
        
        .stat-value{

        font-size:28px;

        font-weight:700;

        color:#111827;

        }
        
        .stat-label {
            color: #64748b;
            font-size: 0.875rem;
        }
        
        /* Tables */
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            background: #f8fafc;
            font-weight: 600;
            color: #475569;
            text-transform: none;
            font-size: 0.875rem;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .table td {
            vertical-align: middle;
            color: #334155;
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .btn-light {
            background: #f1f5f9;
            border-color: #e2e8f0;
            color: #475569;
        }
        
        .btn-light:hover {
            background: #e2e8f0;
        }
        
        /* Badges */
        .badge {
            font-weight: 500;
            padding: 0.4em 0.75em;
            border-radius: 0.375rem;
        }
        
        .badge.bg-success {
            background: rgba(34, 197, 94, 0.1) !important;
            color: #16a34a !important;
        }
        
        .badge.bg-danger {
            background: rgba(239, 68, 68, 0.1) !important;
            color: #dc2626 !important;
        }
        
        .badge.bg-warning {
            background: rgba(245, 158, 11, 0.1) !important;
            color: #d97706 !important;
        }
        
        .badge.bg-info {
            background: rgba(14, 165, 233, 0.1) !important;
            color: #0284c7 !important;
        }
        
        .badge.bg-primary {
            background: rgba(79, 70, 229, 0.1) !important;
            color: #4f46e5 !important;
        }
        
        .badge.bg-pink {
            background: rgba(236, 72, 153, 0.1) !important;
            color: #db2777 !important;
        }
        
        /* Forms */
        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: 0.5rem;
            border-color: #d1d5db;
            padding: 0.625rem 0.875rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        /* Pagination Styling */
        .pagination {
            margin-bottom: 0;
            gap: 5px;
        }
        
        .page-link {
            border-radius: 0.5rem !important;
            padding: 0.4rem 0.8rem;
            color: #475569;
            border-color: #e2e8f0;
            font-size: 0.875rem;
        }
        
        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .card-footer.pagination-compact {
            padding: 0.75rem 1.25rem;
            background-color: #fff;
            border-top: 1px solid #e2e8f0;
        }
        
        .pagination-info {
            font-size: 0.875rem;
            color: #64748b;
        }
        
        /* Flash Messages */
        .alert {
            border: none;
            border-radius: 0.5rem;
        }
        
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #166534;
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #991b1b;
        }
        
        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #92400e;
        }
        
        /* ===== BRAND SIDEBAR ===== */
            .sidebar-brand {
                padding: 1.2rem 1rem;
                border-bottom: 1px solid rgba(255,255,255,0.08);
                background: rgba(255,255,255,0.02);
            }

            .brand-logo {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .brand-logo img {
                width: 48px;
                height: 48px;
                object-fit: contain;
                border-radius: 12px;
                background: transparent;
                flex-shrink: 0;
                
                /* efek elegant */
                filter: drop-shadow(0 4px 10px rgba(255, 0, 80, 0.15));
                
                transition: all 0.3s ease;
            }

            .brand-logo img:hover {
                transform: scale(1.05);
            }

            .brand-text {
                display: flex;
                flex-direction: column;
                overflow: hidden;
            }

            .brand-title {
                color: #ffffff;
                font-size: 1.05rem;
                font-weight: 700;
                line-height: 1.2;
                margin: 0;
                white-space: nowrap;
            }

            .brand-subtitle {
                color: #94a3b8;
                font-size: 0.68rem;
                letter-spacing: 1px;
                text-transform: uppercase;
                margin-top: 2px;
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 991px) {
                .sidebar {
                    transform: translateX(-100%);
                }

                .sidebar.show {
                    transform: translateX(0);
                }

                .main-content {
                    margin-left: 0;
                }
            }

    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
       <div class="sidebar-brand">
    <div class="brand-logo">
        <img 
            src="{{ asset('images/foto logo.png') }}" 
            alt="Gym Membership Logo"
        >

        <div class="brand-text">
            <div class="brand-title">
                GYM Membership
            </div>

        </div>
    </div>
</div>
        
        <div class="sidebar-menu">
            <div class="sidebar-label">Menu Utama</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}" href="{{ route('anggota.index') }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Anggota</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">
                        <i class="bi bi-cash-stack"></i>
                        <span>Transaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('presensi.*') ? 'active' : '' }}" href="{{ route('presensi.index') }}">
                        <i class="bi bi-calendar-check"></i>
                        <span>Presensi</span>
                    </a>
                </li>
            </ul>
            
            @if(auth()->user()->isAdmin())
            <div class="sidebar-divider"></div>
            <div class="sidebar-label">Master Data</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('paket-gym.*') ? 'active' : '' }}" href="{{ route('paket-gym.index') }}">
                        <i class="bi bi-card-checklist"></i>
                        <span>Paket Gym</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('alat-gym.*') ? 'active' : '' }}" href="{{ route('alat-gym.index') }}">
                        <i class="fa-solid fa-dumbbell"></i>
                        <span>Alat Gym</span>
                    </a>
                </li>

                <div class="sidebar-menu">
            <div class="sidebar-label">Menu Utama</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                        <i class="bi bi-person-badge-fill"></i>
                        <span>User Management</span>
                    </a>
                </li>
            </ul>
            @endif
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">

            <div class="d-flex align-items-center">

                <button class="btn btn-light d-lg-none me-3" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>

            </div>

            <div class="dropdown">

                <div class="user-dropdown"
                    data-bs-toggle="dropdown">

                    <div class="user-avatar">
                        {{ auth()->user()->initials }}
                    </div>

                    <div class="user-info d-none d-md-block">

                        <div class="name">
                            {{ auth()->user()->nama }}
                        </div>

                        <div class="role">
                            {{ auth()->user()->role_label }}
                        </div>

                    </div>

                    <i class="bi bi-chevron-down"></i>

                </div>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                    <li>
                        <a class="dropdown-item"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">

                            <i class="bi bi-box-arrow-right me-2"></i>

                            Logout

                        </a>
                    </li>

                </ul>

                <form id="logout-form"
                    action="{{ route('logout') }}"
                    method="POST"
                    class="d-none">

                    @csrf

                </form>

            </div>

        </div>
        
        <!-- Page Content -->
        <div class="page-content">
            <!-- Flash Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @yield('content')
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>
    
    @stack('scripts')
</body>
</html>