@extends('layouts.app')

@section('title', 'Chi tiết đặt phòng - HotelHub')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <!-- Success Banner -->
    <div class="bg-green-50 border border-green-200 rounded-2xl p-6 mb-8 text-center">
        <i class="fas fa-check-circle text-green-500 text-5xl mb-3"></i>
        <h1 class="text-2xl font-bold text-green-700">Đặt phòng thành công!</h1>
        <p class="text-green-600 mt-1">Mã đặt phòng: <span class="font-bold">{{ $booking->booking_reference }}</span></p>
    </div>

    <!-- Booking Details -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-5 pb-3 border-b">Thông tin đặt phòng</h2>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-500 text-sm">Khách sạn</p>
                <p class="font-medium text-gray-800">{{ $booking->hotel->name }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Loại phòng</p>
                <p class="font-medium text-gray-800">{{ $booking->room->name }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Nhận phòng</p>
                <p class="font-medium text-gray-800">{{ $booking->check_in_date->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Trả phòng</p>
                <p class="font-medium text-gray-800">{{ $booking->check_out_date->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Số đêm</p>
                <p class="font-medium text-gray-800">{{ $booking->number_of_nights }} đêm</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Số khách</p>
                <p class="font-medium text-gray-800">{{ $booking->number_of_guests }} khách</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Tên khách</p>
                <p class="font-medium text-gray-800">{{ $booking->guest_name }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Email</p>
                <p class="font-medium text-gray-800">{{ $booking->guest_email }}</p>
            </div>
        </div>

        <!-- Status -->
        <div class="mt-4 pt-4 border-t">
            <p class="text-gray-500 text-sm">Trạng thái</p>
            <span class="inline-block mt-1 px-3 py-1 rounded-full text-sm font-medium
                {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                {{ $booking->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}">
                {{ ucfirst($booking->status) }}
            </span>
        </div>
    </div>

    <!-- Price Summary -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-5 pb-3 border-b">Chi tiết thanh toán</h2>

        <div class="space-y-3">
            <div class="flex justify-between text-gray-600">
                <span>${{ number_format($booking->room_price_per_night) }} x {{ $booking->number_of_nights }} đêm</span>
                <span>${{ number_format($booking->subtotal) }}</span>
            </div>
            <div class="flex justify-between text-gray-600">
                <span>Thuế (10%)</span>
                <span>${{ number_format($booking->taxes) }}</span>
            </div>
            <div class="flex justify-between text-gray-600">
                <span>Phí dịch vụ</span>
                <span>${{ number_format($booking->service_fee) }}</span>
            </div>
            @if($booking->discount > 0)
            <div class="flex justify-between text-green-600">
                <span>Giảm giá</span>
                <span>-${{ number_format($booking->discount) }}</span>
            </div>
            @endif
            <div class="flex justify-between font-bold text-lg text-gray-800 pt-3 border-t">
                <span>Tổng cộng</span>
                <span class="text-blue-600">${{ number_format($booking->total_amount) }}</span>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex gap-4">
        <a href="{{ route('bookings.index') }}"
            class="flex-1 text-center bg-white border-2 border-blue-600 text-blue-600 py-3 rounded-lg hover:bg-blue-50 font-medium transition duration-200">
            <i class="fas fa-list mr-2"></i>Xem tất cả đặt phòng
        </a>
        @if($booking->status !== 'cancelled')
        <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="flex-1"
            onsubmit="return confirm('Bạn có chắc muốn hủy đặt phòng này?')">
            @csrf
            <button type="submit"
                class="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 font-medium transition duration-200">
                <i class="fas fa-times mr-2"></i>Hủy đặt phòng
            </button>
        </form>
        @endif
    </div>
</div>
@endsection