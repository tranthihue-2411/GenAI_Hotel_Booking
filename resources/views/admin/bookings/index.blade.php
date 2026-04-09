@extends('admin.layouts.app')

@section('title', 'Quản lý đặt phòng - Admin')
@section('page-title', 'Quản lý đặt phòng')

@section('content')
<!-- Filters -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-6">
    <form action="{{ route('admin.bookings.index') }}" method="GET">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Tìm kiếm</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Mã, tên, email...">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Trạng thái</label>
                <select name="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option value="">Tất cả</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Từ ngày</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Đến ngày</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>
        </div>
        <div class="flex gap-3 mt-4">
            <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200">
                <i class="fas fa-search mr-2"></i>Tìm kiếm
            </button>
            <a href="{{ route('admin.bookings.index') }}"
                class="bg-gray-100 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-200 text-sm font-medium transition duration-200">
                Xóa bộ lọc
            </a>
        </div>
    </form>
</div>

<!-- Bookings Table -->
<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr class="text-left text-gray-500 text-sm">
                <th class="px-6 py-4">Mã đặt phòng</th>
                <th class="px-6 py-4">Khách hàng</th>
                <th class="px-6 py-4">Khách sạn</th>
                <th class="px-6 py-4">Ngày</th>
                <th class="px-6 py-4">Trạng thái</th>
                <th class="px-6 py-4">Tổng tiền</th>
                <th class="px-6 py-4">Thao tác</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($bookings as $booking)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="px-6 py-4">
                    <a href="{{ route('admin.bookings.show', $booking) }}"
                        class="text-blue-600 hover:underline font-medium text-sm">
                        {{ $booking->booking_reference }}
                    </a>
                </td>
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-800 text-sm">{{ $booking->guest_name }}</p>
                    <p class="text-gray-400 text-xs">{{ $booking->guest_email }}</p>
                </td>
                <td class="px-6 py-4 text-gray-700 text-sm">{{ $booking->hotel->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    <p>{{ $booking->check_in_date->format('d/m/Y') }}</p>
                    <p class="text-gray-400">→ {{ $booking->check_out_date->format('d/m/Y') }}</p>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $booking->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 font-bold text-gray-800">${{ number_format($booking->total_amount) }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.bookings.show', $booking) }}"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        <i class="fas fa-eye mr-1"></i>Xem
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-16 text-center text-gray-400">
                    <i class="fas fa-calendar-times text-5xl mb-4 block"></i>
                    Không có đặt phòng nào
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="px-6 py-4 border-t">
        {{ $bookings->links() }}
    </div>
</div>
@endsection