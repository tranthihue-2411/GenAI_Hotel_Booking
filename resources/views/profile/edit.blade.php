@extends('layouts.app')

@section('title', 'Hồ sơ của tôi - HotelHub')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">
        <i class="fas fa-user-circle mr-3 text-blue-600"></i>Hồ sơ của tôi
    </h1>

    @if(session('status'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
        <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
    </div>
    @endif

    <!-- Profile Info -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-5 pb-3 border-b">
            <i class="fas fa-user mr-2 text-blue-600"></i>Thông tin cá nhân
        </h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Họ và tên</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
                <i class="fas fa-save mr-2"></i>Lưu thay đổi
            </button>
        </form>
    </div>

    <!-- Change Password -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-5 pb-3 border-b">
            <i class="fas fa-lock mr-2 text-blue-600"></i>Đổi mật khẩu
        </h2>

        <form method="POST" action="{{ route('profile.password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Mật khẩu hiện tại</label>
                <input type="password" name="current_password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('current_password') border-red-500 @enderror"
                    placeholder="••••••••">
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Mật khẩu mới</label>
                <input type="password" name="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                    placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Xác nhận mật khẩu mới</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
                <i class="fas fa-key mr-2"></i>Đổi mật khẩu
            </button>
        </form>
    </div>
</div>
@endsection