<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/admin-style.css') }}" rel="stylesheet">
    <!-- Custom User Sidebar Styles -->
    <style>
        .user-sidebar {
            background: #ffffff !important;
            border-right: 1px solid #f1f3f5;
            box-shadow: 2px 0 15px rgba(0,0,0,0.02) !important;
            width: 280px;
        }
        
        .user-sidebar-brand {
            padding: 1.75rem 1.25rem;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .user-sidebar-brand h4 {
            color: #d35400 !important;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .user-sidebar-brand h4 i {
            color: #d35400;
            margin-right: 10px;
            font-size: 1.4rem;
        }
        
        .user-sidebar .nav-link {
            color: #6c757d !important;
            font-weight: 600;
            padding: 0.85rem 1rem !important;
            margin: 0.4rem 1rem !important;
            border-radius: 12px !important;
            transition: all 0.2s ease !important;
            display: flex !important;
            align-items: center !important;
            font-size: 0.95rem;
        }
        
        .user-sidebar .nav-link:hover {
            background-color: #fff3ec !important;
            color: #d35400 !important;
            transform: translateX(4px) !important;
        }
        
        .user-sidebar .nav-link.active {
            background: #d35400 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(211, 84, 0, 0.2) !important;
            transform: translateX(4px) !important;
        }

        .user-sidebar .nav-link.text-danger:hover {
            background-color: #fff5f5 !important;
            color: #dc3545 !important;
        }
        
        .user-sidebar .nav-link i {
            font-size: 1.25rem;
            margin-right: 12px !important;
            width: 24px;
            text-align: center;
            opacity: 0.8;
        }

        .user-sidebar .nav-link.active i {
            opacity: 1;
        }
    </style>
</head>

<body style="background-color: #f8f9fa;">

    <!-- Mobile Top Navbar -->
    <nav class="navbar navbar-light bg-white d-md-none fixed-top shadow-sm border-bottom">
        <div class="container-fluid">
            <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar"
                aria-controls="mobileSidebar">
                <i class="fas fa-bars fs-4 text-dark"></i>
            </button>
            <span class="navbar-brand mb-0 h1 fw-bold" style="color: #d35400;">
                <i class="fas fa-utensils me-2"></i> User
            </span>
        </div>
    </nav>

    <!-- Offcanvas Sidebar for Mobile -->
    <div class="offcanvas offcanvas-start d-md-none user-sidebar" tabindex="-1" id="mobileSidebar">
        <div class="user-sidebar-brand d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-utensils"></i> Imperial Spice</h4>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0 pt-2">
            @include('user.sidebar-menu')
        </div>
    </div>

    <!-- Page Wrapper -->
    <div class="d-flex flex-column flex-md-row min-vh-100 mt-5 mt-md-0">
        
        <!-- Desktop Sidebar -->
        <nav class="d-none d-md-block user-sidebar flex-shrink-0">
            <div class="position-sticky top-0 vh-100 overflow-y-auto">
                <div class="user-sidebar-brand d-none d-md-block">
                    <h4><i class="fas fa-utensils"></i> Imperial Spice</h4>
                </div>
                <div class="pt-2">
                    @include('user.sidebar-menu')
                </div>
            </div>
        </nav>

        <!-- Main Content Area -->
        <div class="flex-grow-1 w-100">
            @yield('content')
        </div>

    </div>

    @include('user.footer')