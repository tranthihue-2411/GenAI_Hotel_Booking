<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - HotelHub')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white flex-shrink-0">
        <!-- Logo -->
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center space-x-2">
                <i class="fas fa-hotel text-blue-400 text-2xl"></i>
                <span class="text-xl font-bold">HotelHub Admin</span>
            </div>
        </div>

        <!-- Nav -->
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition duration-200
                {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.hotels.index') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition duration-200
                {{ request()->routeIs('admin.hotels.*') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-hotel w-5"></i>
                <span>Quản lý khách sạn</span>
            </a>
            <a href="{{ route('admin.bookings.index') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition duration-200
                {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-calendar-alt w-5"></i>
                <span>Quản lý đặt phòng</span>
            </a>
            <div class="border-t border-gray-700 pt-4 mt-4">
                <a href="{{ route('home') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition duration-200">
                    <i class="fas fa-globe w-5"></i>
                    <span>Về trang chủ</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition duration-200 text-left">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Đăng xuất</span>
                    </button>
                </form>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center space-x-3">
                <i class="fas fa-user-shield text-blue-600"></i>
                <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
        <div class="mx-6 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
        @endif

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>