@extends('layouts.app')

@section('title', 'Đăng ký - HotelHub')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <i class="fas fa-hotel text-blue-600 text-4xl mb-3"></i>
            <h2 class="text-2xl font-bold text-gray-800">Đăng ký tài khoản</h2>
            <p class="text-gray-500 mt-1">Tham gia HotelHub ngay hôm nay</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Họ và tên</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    placeholder="Nguyễn Văn A">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

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
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Mật khẩu</label>
                <input type="password" name="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                    placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••">
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
                <i class="fas fa-user-plus mr-2"></i>Đăng ký
            </button>
        </form>

        <!-- Login Link -->
        <p class="text-center text-gray-600 mt-6">
            Đã có tài khoản?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Đăng nhập</a>
        </p>
    </div>
</div>
@endsection