<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HotelHub - Đặt Phòng Khách Sạn')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <i class="fas fa-hotel text-blue-600 text-2xl"></i>
                    <span class="text-xl font-bold text-blue-600">HotelHub</span>
                </a>

                <!-- Nav Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 font-medium">Trang chủ</a>
                    <a href="{{ route('hotels.search') }}" class="text-gray-600 hover:text-blue-600 font-medium">Khách sạn</a>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium">Đăng ký</a>
                    @else
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-blue-600 font-medium">
                                <i class="fas fa-tachometer-alt mr-1"></i>Admin
                            </a>
                        @endif
                        <a href="{{ route('bookings.index') }}" class="text-gray-600 hover:text-blue-600 font-medium">Đặt phòng của tôi</a>
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600">
                                <i class="fas fa-user-circle text-xl"></i>
                                <span>{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden group-hover:block">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i>Hồ sơ
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex items-center justify-center space-x-2 mb-4">
                <i class="fas fa-hotel text-blue-400 text-xl"></i>
                <span class="text-xl font-bold">HotelHub</span>
            </div>
            <p class="text-gray-400">© 2024 HotelHub. Hệ thống đặt phòng khách sạn trực tuyến.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>