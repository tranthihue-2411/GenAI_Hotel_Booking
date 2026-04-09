@extends('admin.layouts.app')

@section('title', 'Quản lý khách sạn - Admin')
@section('page-title', 'Quản lý khách sạn')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500">Tổng cộng {{ $hotels->total() }} khách sạn</p>
    <a href="{{ route('admin.hotels.create') }}"
        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
        <i class="fas fa-plus mr-2"></i>Thêm khách sạn
    </a>
</div>

<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr class="text-left text-gray-500 text-sm">
                <th class="px-6 py-4">Khách sạn</th>
                <th class="px-6 py-4">Địa điểm</th>
                <th class="px-6 py-4">Đánh giá</th>
                <th class="px-6 py-4">Trạng thái</th>
                <th class="px-6 py-4">Thao tác</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($hotels as $hotel)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ $hotel->main_image ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=100&h=100&fit=crop' }}"
                            alt="{{ $hotel->name }}"
                            class="w-12 h-12 rounded-lg object-cover">
                        <div>
                            <p class="font-medium text-gray-800">{{ $hotel->name }}</p>
                            <p class="text-gray-400 text-xs">{{ $hotel->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-600 text-sm">
                    {{ $hotel->city }}, {{ $hotel->province }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400 text-sm mr-1"></i>
                        <span class="font-medium text-gray-800">{{ number_format($hotel->rating, 1) }}</span>
                        <span class="text-gray-400 text-xs ml-1">({{ $hotel->review_count }})</span>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                        {{ $hotel->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $hotel->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.hotels.show', $hotel) }}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            <i class="fas fa-eye mr-1"></i>Xem
                        </a>
                        <a href="{{ route('admin.hotels.edit', $hotel) }}"
                            class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">
                            <i class="fas fa-edit mr-1"></i>Sửa
                        </a>
                        <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc muốn xóa khách sạn này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                <i class="fas fa-trash mr-1"></i>Xóa
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                    <i class="fas fa-hotel text-5xl mb-4 block"></i>
                    Chưa có khách sạn nào
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="px-6 py-4 border-t">
        {{ $hotels->links() }}
    </div>
</div>
@endsection