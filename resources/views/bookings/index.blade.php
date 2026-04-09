@extends('layouts.app')

@section('title', 'Đặt phòng của tôi - HotelHub')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">
        <i class="fas fa-calendar-alt mr-3 text-blue-600"></i>Đặt phòng của tôi
    </h1>

    @forelse($bookings as $booking)
    <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6 hover:shadow-lg transition duration-300">
        <div class="flex">
            <!-- Hotel Image -->
            <img src="{{ $booking->hotel->main_image ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop' }}"
                alt="{{ $booking->hotel->name }}"
                class="w-48 h-40 object-cover flex-shrink-0">

            <!-- Content -->
            <div class="p-5 flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $booking->hotel->name }}</h3>
                        <p class="text-gray-500 text-sm mt-1">
                            <i class="fas fa-bed mr-1"></i>{{ $booking->room->name }}
                        </p>
                        <p class="text-gray-500 text-sm mt-1">
                            <i class="fas fa-hashtag mr-1"></i>{{ $booking->booking_reference }}
                        </p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $booking->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-3 gap-4 mt-4">
                    <div>
                        <p class="text-gray-400 text-xs">Nhận phòng</p>
                        <p class="font-medium text-gray-700 text-sm">{{ $booking->check_in_date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Trả phòng</p>
                        <p class="font-medium text-gray-700 text-sm">{{ $booking->check_out_date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Tổng tiền</p>
                        <p class="font-bold text-blue-600">${{ number_format($booking->total_amount) }}</p>
                    </div>
                </div>

                <div class="flex gap-3 mt-4">
                    <a href="{{ route('bookings.show', $booking) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200">
                        <i class="fas fa-eye mr-1"></i>Xem chi tiết
                    </a>
                    @if($booking->status !== 'cancelled')
                    <form action="{{ route('bookings.cancel', $booking) }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc muốn hủy đặt phòng này?')">
                        @csrf
                        <button type="submit"
                            class="bg-red-50 text-red-600 border border-red-300 px-4 py-2 rounded-lg hover:bg-red-100 text-sm font-medium transition duration-200">
                            <i class="fas fa-times mr-1"></i>Hủy
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl shadow-md p-16 text-center">
        <i class="fas fa-calendar-times text-gray-300 text-7xl mb-6"></i>
        <h3 class="text-xl font-bold text-gray-600 mb-2">Chưa có đặt phòng nào</h3>
        <p class="text-gray-400 mb-6">Hãy tìm kiếm và đặt phòng khách sạn yêu thích của bạn</p>
        <a href="{{ route('hotels.search') }}"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
            <i class="fas fa-search mr-2"></i>Tìm khách sạn
        </a>
    </div>
    @endforelse

    <!-- Pagination -->
    <div class="mt-6">
        {{ $bookings->links() }}
    </div>
</div>
@endsection