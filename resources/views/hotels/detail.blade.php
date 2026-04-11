@extends('layouts.app')

@section('title', $hotel->name . ' - HotelHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Hotel Header -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8">
        <img src="{{ $hotel->main_image ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop' }}"
            alt="{{ $hotel->name }}"
            class="w-full h-80 object-cover">

        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $hotel->name }}</h1>
                    <p class="text-gray-500 mt-2">
                        <i class="fas fa-map-marker-alt mr-1 text-blue-500"></i>
                        {{ $hotel->address }}, {{ $hotel->city }}, {{ $hotel->province }}
                    </p>
                    <div class="flex items-center mt-3 space-x-4">
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="font-bold text-gray-800">{{ number_format($hotel->rating, 1) }}</span>
                            <span class="text-gray-500 ml-1">({{ $hotel->review_count }} đánh giá)</span>
                        </div>
                        @if($hotel->phone)
                        <div class="flex items-center text-gray-500">
                            <i class="fas fa-phone mr-1"></i>
                            <span>{{ $hotel->phone }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <p class="text-gray-600 mt-4">{{ $hotel->description }}</p>

            <!-- Amenities -->
            @if($hotel->amenities->count() > 0)
            <div class="mt-5">
                <h3 class="font-bold text-gray-800 mb-3">Tiện nghi khách sạn</h3>
                <div class="flex flex-wrap gap-3">
                    @foreach($hotel->amenities as $amenity)
                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm">
                        {{ $amenity->icon }} {{ $amenity->name }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Rooms -->
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Các loại phòng</h2>

            @forelse($availableRooms as $room)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6">
                <div class="flex">
                    <img src="{{ $room->image ?? 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=600&h=400&fit=crop' }}"
                        alt="{{ $room->name }}"
                        class="w-48 h-40 object-cover flex-shrink-0">
                    <div class="p-5 flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $room->name }}</h3>
                                <p class="text-gray-500 text-sm mt-1">
                                    <i class="fas fa-bed mr-1"></i>{{ $room->bed_type }}
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-user mr-1"></i>Tối đa {{ $room->max_guests }} khách
                                    @if($room->size_sqm)
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-expand mr-1"></i>{{ $room->size_sqm }}m²
                                    @endif
                                </p>
                            </div>
                            <div class="text-right">
                                <div class="text-blue-600 font-bold text-xl">${{ number_format($room->price_per_night) }}</div>
                                <div class="text-gray-400 text-sm">/đêm</div>
                            </div>
                        </div>

                        @if($room->amenities)
                        <div class="flex flex-wrap gap-2 mt-3">
                            @foreach($room->amenities as $amenity)
                            <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $amenity }}</span>
                            @endforeach
                        </div>
                        @endif

                        <!-- Booking Form -->
                        @auth
                        <form action="{{ route('bookings.store') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <div class="grid grid-cols-2 gap-2 mb-3">
                                <div>
                                    <label class="text-xs text-gray-500">Nhận phòng</label>
                                    <input type="date" name="check_in_date" required
                                        min="{{ date('Y-m-d') }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500">Trả phòng</label>
                                    <input type="date" name="check_out_date" required
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500">Số khách</label>
                                    <input type="number" name="number_of_guests" value="1" min="1" max="{{ $room->max_guests }}" required
                                        class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500">Tên khách</label>
                                    <input type="text" name="guest_name" value="{{ auth()->user()->name }}" required
                                        class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>
                            <input type="hidden" name="guest_email" value="{{ auth()->user()->email }}">
                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200">
                                <i class="fas fa-calendar-check mr-1"></i>Đặt phòng ngay
                            </button>
                        </form>
                        @else
                        <div class="mt-4">
                            <a href="{{ route('login') }}"
                                class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200">
                                <i class="fas fa-sign-in-alt mr-1"></i>Đăng nhập để đặt phòng
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl shadow-md p-8 text-center">
                <i class="fas fa-bed text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500">Không có phòng trống trong thời gian này</p>
            </div>
            @endforelse
        </div>

        <!-- Reviews -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Đánh giá</h2>

            <!-- Rating Summary -->
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <div class="text-center">
                    <div class="text-5xl font-bold text-blue-600">{{ number_format($hotel->rating, 1) }}</div>
                    <div class="flex justify-center text-yellow-400 mt-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= round($hotel->rating) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                    <p class="text-gray-500 mt-1">{{ $hotel->review_count }} đánh giá</p>
                </div>
            </div>

            <!-- Review List -->
            @forelse($hotel->reviews as $review)
            <div class="bg-white rounded-2xl shadow-md p-5 mb-4">
                <div class="flex items-center mb-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                        {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">{{ $review->user->name ?? 'Khách hàng' }}</p>
                        <div class="flex text-yellow-400 text-sm">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">{{ $review->comment }}</p>
            </div>
            @empty
            <div class="bg-white rounded-2xl shadow-md p-6 text-center">
                <p class="text-gray-500">Chưa có đánh giá nào</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection