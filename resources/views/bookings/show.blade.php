@extends('layouts.app')

@section('title', 'Chi tiết đặt phòng - HotelHub')

@section('content')

<!-- Page Header -->
<div class="bg-white border-b border-slate-100">
    <div class="max-w-4xl mx-auto px-6 py-5">
        <div class="flex items-center gap-2 text-sm text-slate-400 mb-1">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Trang chủ</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('bookings.index') }}" class="hover:text-blue-600 transition-colors">Đặt phòng của tôi</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-slate-600 font-medium">{{ $booking->booking_reference }}</span>
        </div>
        <h1 class="text-2xl font-bold text-slate-800">Chi tiết đặt phòng</h1>
    </div>
</div>

<div class="max-w-4xl mx-auto px-6 py-8">

    <!-- Success Banner -->
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-5 mb-6 flex items-center gap-3">
        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
            <i class="fas fa-check text-emerald-600"></i>
        </div>
        <div>
            <p class="font-semibold text-emerald-700">Đặt phòng thành công!</p>
            <p class="text-emerald-600 text-sm">Mã đặt phòng: <span class="font-bold">{{ $booking->booking_reference }}</span></p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Cột trái -->
        <div class="lg:col-span-2 space-y-5">

            <!-- Booking Info -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
                    <h2 class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="fas fa-calendar-check text-blue-500 text-sm"></i>
                        Thông tin đặt phòng
                    </h2>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $booking->status === 'confirmed' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : '' }}
                        {{ $booking->status === 'pending' ? 'bg-amber-50 text-amber-600 border border-amber-100' : '' }}
                        {{ $booking->status === 'cancelled' ? 'bg-red-50 text-red-500 border border-red-100' : '' }}
                        {{ $booking->status === 'completed' ? 'bg-blue-50 text-blue-600 border border-blue-100' : '' }}">
                        <i class="fas fa-circle text-xs mr-1"></i>{{ ucfirst($booking->status) }}
                    </span>
                </div>

                <div class="p-6">
                    <!-- Hotel & Room -->
                    <div class="flex gap-4 mb-5 pb-5 border-b border-slate-50">
                        <img src="{{ $booking->hotel->main_image ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=200&h=150&fit=crop' }}"
                            alt="{{ $booking->hotel->name }}"
                            class="w-24 h-18 rounded-xl object-cover flex-shrink-0" style="height:72px;">
                        <div>
                            <h3 class="font-bold text-slate-800">{{ $booking->hotel->name }}</h3>
                            <p class="text-slate-400 text-sm mt-0.5">
                                <i class="fas fa-bed mr-1 text-slate-300"></i>{{ $booking->room->name }}
                            </p>
                            <p class="text-slate-400 text-xs mt-1">
                                <i class="fas fa-hashtag mr-1 text-slate-300"></i>{{ $booking->booking_reference }}
                            </p>
                        </div>
                    </div>

                    <!-- Dates Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-5 pb-5 border-b border-slate-50">
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                            <p class="text-slate-400 text-xs mb-1">
                                <i class="fas fa-sign-in-alt mr-1 text-blue-400"></i>Nhận phòng
                            </p>
                            <p class="font-bold text-slate-800">{{ $booking->check_in_date->format('d/m/Y') }}</p>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                            <p class="text-slate-400 text-xs mb-1">
                                <i class="fas fa-sign-out-alt mr-1 text-blue-400"></i>Trả phòng
                            </p>
                            <p class="font-bold text-slate-800">{{ $booking->check_out_date->format('d/m/Y') }}</p>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                            <p class="text-slate-400 text-xs mb-1">
                                <i class="fas fa-moon mr-1 text-blue-400"></i>Số đêm
                            </p>
                            <p class="font-bold text-slate-800">{{ $booking->number_of_nights }} đêm</p>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                            <p class="text-slate-400 text-xs mb-1">
                                <i class="fas fa-user mr-1 text-blue-400"></i>Số khách
                            </p>
                            <p class="font-bold text-slate-800">{{ $booking->number_of_guests }} khách</p>
                        </div>
                    </div>

                    <!-- Guest Info -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-slate-400 text-xs mb-1">Tên khách</p>
                            <p class="font-semibold text-slate-700 text-sm">{{ $booking->guest_name }}</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-xs mb-1">Email</p>
                            <p class="font-semibold text-slate-700 text-sm">{{ $booking->guest_email }}</p>
                        </div>
                        @if($booking->guest_phone)
                        <div>
                            <p class="text-slate-400 text-xs mb-1">Điện thoại</p>
                            <p class="font-semibold text-slate-700 text-sm">{{ $booking->guest_phone }}</p>
                        </div>
                        @endif
                        @if($booking->special_requests)
                        <div class="col-span-2">
                            <p class="text-slate-400 text-xs mb-1">Yêu cầu đặc biệt</p>
                            <p class="font-semibold text-slate-700 text-sm">{{ $booking->special_requests }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3">
                <a href="{{ route('bookings.index') }}"
                    class="flex-1 text-center border border-slate-200 text-slate-600 hover:bg-slate-50 py-3 rounded-xl text-sm font-semibold transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-list"></i> Tất cả đặt phòng
                </a>
                @if($booking->status !== 'cancelled' && $booking->status !== 'completed')
                <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="flex-1"
                    onsubmit="return confirm('Bạn có chắc muốn hủy đặt phòng này?')">
                    @csrf
                    <button type="submit"
                        class="w-full border border-red-200 text-red-500 hover:bg-red-50 py-3 rounded-xl text-sm font-semibold transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-times-circle"></i> Hủy đặt phòng
                    </button>
                </form>
                @endif
            </div>
        </div>

        <!-- Cột phải - Payment Summary -->
        <div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden sticky top-20">
                <div class="bg-blue-600 px-6 py-5">
                    <p class="text-blue-200 text-xs font-medium mb-1">Tổng thanh toán</p>
                    <p class="text-white font-bold text-3xl">${{ number_format($booking->total_amount) }}</p>
                </div>
                <div class="p-5 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">${{ number_format($booking->room_price_per_night) }} × {{ $booking->number_of_nights }} đêm</span>
                        <span class="text-slate-700 font-medium">${{ number_format($booking->subtotal) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Thuế (10%)</span>
                        <span class="text-slate-700 font-medium">${{ number_format($booking->taxes) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Phí dịch vụ</span>
                        <span class="text-slate-700 font-medium">${{ number_format($booking->service_fee) }}</span>
                    </div>
                    @if($booking->discount > 0)
                    <div class="flex justify-between text-sm">
                        <span class="text-emerald-500">Giảm giá</span>
                        <span class="text-emerald-500 font-medium">-${{ number_format($booking->discount) }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between font-bold text-slate-800 pt-3 border-t border-slate-100">
                        <span>Tổng cộng</span>
                        <span class="text-blue-600 text-lg">${{ number_format($booking->total_amount) }}</span>
                    </div>
                </div>

                <!-- Trust -->
                <div class="px-5 pb-5 space-y-2">
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <i class="fas fa-shield-alt text-emerald-500"></i>
                        <span>Thanh toán an toàn & bảo mật</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <i class="fas fa-headset text-blue-500"></i>
                        <span>Hỗ trợ 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection