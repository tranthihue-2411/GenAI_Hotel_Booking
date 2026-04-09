@extends('admin.layouts.app')

@section('title', 'Chi tiết đặt phòng - Admin')
@section('page-title', 'Chi tiết đặt phòng')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.bookings.index') }}" class="text-blue-600 hover:underline text-sm">
        <i class="fas fa-arrow-left mr-1"></i>Quay lại danh sách
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Booking Info -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Main Info -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex justify-between items-start mb-5 pb-3 border-b">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $booking->booking_reference }}</h2>
                    <p class="text-gray-500 text-sm mt-1">Đặt lúc: {{ $booking->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-sm font-medium
                    {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                    {{ $booking->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-400 text-sm">Khách sạn</p>
                    <p class="font-medium text-gray-800">{{ $booking->hotel->name }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Loại phòng</p>
                    <p class="font-medium text-gray-800">{{ $booking->room->name }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Nhận phòng</p>
                    <p class="font-medium text-gray-800">{{ $booking->check_in_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Trả phòng</p>
                    <p class="font-medium text-gray-800">{{ $booking->check_out_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Số đêm</p>
                    <p class="font-medium text-gray-800">{{ $booking->number_of_nights }} đêm</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Số khách</p>
                    <p class="font-medium text-gray-800">{{ $booking->number_of_guests }} khách</p>
                </div>
            </div>
        </div>

        <!-- Guest Info -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="font-bold text-gray-800 mb-4 pb-3 border-b">Thông tin khách hàng</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-400 text-sm">Họ tên</p>
                    <p class="font-medium text-gray-800">{{ $booking->guest_name }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Email</p>
                    <p class="font-medium text-gray-800">{{ $booking->guest_email }}</p>
                </div>
                @if($booking->guest_phone)
                <div>
                    <p class="text-gray-400 text-sm">Điện thoại</p>
                    <p class="font-medium text-gray-800">{{ $booking->guest_phone }}</p>
                </div>
                @endif
                @if($booking->special_requests)
                <div class="col-span-2">
                    <p class="text-gray-400 text-sm">Yêu cầu đặc biệt</p>
                    <p class="font-medium text-gray-800">{{ $booking->special_requests }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Update Status -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="font-bold text-gray-800 mb-4 pb-3 border-b">Cập nhật trạng thái</h3>
            <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="flex gap-4">
                    <select name="status"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
                        <i class="fas fa-save mr-2"></i>Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Payment Summary -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="font-bold text-gray-800 mb-4 pb-3 border-b">Chi tiết thanh toán</h3>
            <div class="space-y-3">
                <div class="flex justify-between text-gray-600 text-sm">
                    <span>${{ number_format($booking->room_price_per_night) }} x {{ $booking->number_of_nights }} đêm</span>
                    <span>${{ number_format($booking->subtotal) }}</span>
                </div>
                <div class="flex justify-between text-gray-600 text-sm">
                    <span>Thuế (10%)</span>
                    <span>${{ number_format($booking->taxes) }}</span>
                </div>
                <div class="flex justify-between text-gray-600 text-sm">
                    <span>Phí dịch vụ</span>
                    <span>${{ number_format($booking->service_fee) }}</span>
                </div>
                @if($booking->discount > 0)
                <div class="flex justify-between text-green-600 text-sm">
                    <span>Giảm giá</span>
                    <span>-${{ number_format($booking->discount) }}</span>
                </div>
                @endif
                <div class="flex justify-between font-bold text-gray-800 pt-3 border-t">
                    <span>Tổng cộng</span>
                    <span class="text-blue-600 text-lg">${{ number_format($booking->total_amount) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection