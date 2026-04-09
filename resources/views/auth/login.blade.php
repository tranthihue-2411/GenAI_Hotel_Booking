@extends('layouts.app')

@section('title', 'Đăng nhập - HotelHub')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <i class="fas fa-hotel text-blue-600 text-4xl mb-3"></i>
            <h2 class="text-2xl font-bold text-gray-800">Đăng nhập</h2>
            <p class="text-gray-500 mt-1">Chào mừng bạn trở lại HotelHub</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                    placeholder="example@email.com">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Mật khẩu</label>
                <input type="password" name="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                    placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-6">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-gray-600">Ghi nhớ đăng nhập</label>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
                <i class="fas fa-sign-in-alt mr-2"></i>Đăng nhập
            </button>
        </form>

        <!-- Register Link -->
        <p class="text-center text-gray-600 mt-6">
            Chưa có tài khoản?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Đăng ký ngay</a>
        </p>

        <!-- Demo Accounts -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <p class="text-sm text-gray-500 font-medium mb-2">Tài khoản demo:</p>
            <p class="text-sm text-gray-600"><i class="fas fa-user-shield mr-1 text-blue-500"></i>Admin: admin@hotelhub.com / password</p>
            <p class="text-sm text-gray-600"><i class="fas fa-user mr-1 text-green-500"></i>User: user@hotelhub.com / password</p>
        </div>
    </div>
</div>
@endsection