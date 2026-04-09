@extends('admin.layouts.app')

@section('title', $hotel->name . ' - Admin')
@section('page-title', 'Chi tiết khách sạn')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.hotels.index') }}" class="text-blue-600 hover:underline text-sm">
        <i class="fas fa-arrow-left mr-1"></i>Quay lại danh sách
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Hotel Info -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6">
            <img src="{{ $hotel->main_image ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop' }}"
                alt="{{ $hotel->name }}"
                class="w-full h-56 object-cover">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $hotel->name }}</h2>
                        <p class="text-gray-500 mt-1">
                            <i class="fas fa-map-marker-alt mr-1 text-blue-500"></i>
                            {{ $hotel->address }}, {{ $hotel->city }}
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.hotels.edit', $hotel) }}"
                            class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 text-sm font-medium">
                            <i class="fas fa-edit mr-1"></i>Sửa
                        </a>
                    </div>
                </div>
                <p class="text-gray-600 mt-4">{{ $hotel->description }}</p>

                <!-- Amenities -->
                <div class="mt-4">
                    <h3 class="font-bold text-gray-800 mb-2">Tiện nghi</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($hotel->amenities as $amenity)
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm">
                            {{ $amenity->icon }} {{ $amenity->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Rooms -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Danh sách phòng</h3>
            <div class="space-y-3">
                @forelse($hotel->rooms as $room)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-800">{{ $room->name }}</p>
                        <p class="text-gray-500 text-sm">{{ $room->bed_type }} • Tối đa {{ $room->max_guests }} khách</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-blue-600">${{ number_format($room->price_per_night) }}/đêm</p>
                        <span class="text-xs {{ $room->is_active ? 'text-green-600' : 'text-red-600' }}">
                            {{ $room->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-gray-400 text-center py-4">Chưa có phòng nào</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Stats Sidebar -->
    <div class="space-y-6">
        <!-- Quick Stats -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="font-bold text-gray-800 mb-4">Thống kê</h3>
            <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="text-gray-500">Đánh giá</span>
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <span class="font-bold">{{ number_format($hotel->rating, 1) }}</span>
                        <span class="text-gray-400 text-sm ml-1">({{ $hotel->review_count }})</span>
                    </div>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tổng đặt phòng</span>
                    <span class="font-bold text-gray-800">{{ $hotel->bookings->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Số phòng</span>
                    <span class="font-bold text-gray-800">{{ $hotel->rooms->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Trạng thái</span>
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $hotel->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $hotel->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="font-bold text-gray-800 mb-4">Thông tin liên hệ</h3>
            <div class="space-y-3">
                @if($hotel->phone)
                <div class="flex items-center text-gray-600">
                    <i class="fas fa-phone w-5 text-blue-500"></i>
                    <span class="text-sm ml-2">{{ $hotel->phone }}</span>
                </div>
                @endif
                @if($hotel->email)
                <div class="flex items-center text-gray-600">
                    <i class="fas fa-envelope w-5 text-blue-500"></i>
                    <span class="text-sm ml-2">{{ $hotel->email }}</span>
                </div>
                @endif
                @if($hotel->website)
                <div class="flex items-center text-gray-600">
                    <i class="fas fa-globe w-5 text-blue-500"></i>
                    <a href="{{ $hotel->website }}" class="text-sm ml-2 text-blue-600 hover:underline">
                        {{ $hotel->website }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection