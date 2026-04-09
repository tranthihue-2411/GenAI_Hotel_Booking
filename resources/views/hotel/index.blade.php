@extends('layouts.app')

@section('title', 'HotelHub - Trang chủ')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Tìm Khách Sạn Hoàn Hảo Cho Bạn</h1>
        <p class="text-xl text-blue-100 mb-10">Hàng nghìn khách sạn trên khắp Việt Nam với giá tốt nhất</p>

        <!-- Search Form -->
        <div class="bg-white rounded-2xl p-6 max-w-4xl mx-auto shadow-xl">
            <form action="{{ route('hotels.search') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-gray-600 text-sm font-medium mb-1 text-left">Địa điểm</label>
                        <div class="relative">
                            <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400"></i>
                            <input type="text" name="location"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Hà Nội, Đà Nẵng, TP.HCM...">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm font-medium mb-1 text-left">Nhận phòng</label>
                        <input type="date" name="checkin"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            min="{{ date('Y-m-d') }}">
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm font-medium mb-1 text-left">Trả phòng</label>
                        <input type="date" name="checkout"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            min="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <button type="submit"
                    class="mt-4 w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
                    <i class="fas fa-search mr-2"></i>Tìm kiếm khách sạn
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Featured Hotels -->
<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Khách Sạn Nổi Bật</h2>
        <p class="text-gray-500 mt-2">Những khách sạn được yêu thích nhất</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($hotels as $hotel)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
            <!-- Image -->
            <div class="relative">
                <img src="{{ $hotel->main_image ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop' }}"
                    alt="{{ $hotel->name }}"
                    class="w-full h-52 object-cover">
                <div class="absolute top-3 right-3 bg-white rounded-full px-2 py-1 flex items-center shadow">
                    <i class="fas fa-star text-yellow-400 text-sm mr-1"></i>
                    <span class="text-sm font-bold text-gray-800">{{ number_format($hotel->rating, 1) }}</span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-5">
                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $hotel->name }}</h3>
                <p class="text-gray-500 text-sm mb-3">
                    <i class="fas fa-map-marker-alt mr-1 text-blue-500"></i>
                    {{ $hotel->city }}, {{ $hotel->province }}
                </p>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $hotel->description }}</p>

                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-gray-400 text-sm">Từ</span>
                        <span class="text-blue-600 font-bold text-lg ml-1">
                            ${{ number_format($hotel->rooms->min('price_per_night') ?? 0) }}
                        </span>
                        <span class="text-gray-400 text-sm">/đêm</span>
                    </div>
                    <a href="{{ route('hotels.show', $hotel) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200">
                        Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-10">
        <a href="{{ route('hotels.search') }}"
            class="bg-white border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-lg hover:bg-blue-600 hover:text-white font-medium transition duration-200">
            Xem tất cả khách sạn <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-blue-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">{{ $hotels->count() }}+</div>
                <div class="text-blue-100">Khách sạn</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">1000+</div>
                <div class="text-blue-100">Đặt phòng thành công</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">4.8</div>
                <div class="text-blue-100">Điểm đánh giá trung bình</div>
            </div>
        </div>
    </div>
</div>
@endsection