@extends('layouts.app')

@section('title', 'Tìm kiếm khách sạn - HotelHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex gap-8">
        <!-- Sidebar Filters -->
        <div class="w-72 flex-shrink-0">
            <div class="bg-white rounded-2xl shadow-md p-6 sticky top-20">
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-filter mr-2 text-blue-600"></i>Bộ lọc
                </h3>

                <form action="{{ route('hotels.search') }}" method="GET">
                    <!-- Location -->
                    <div class="mb-5">
                        <label class="block text-gray-700 font-medium mb-2">Địa điểm</label>
                        <input type="text" name="location" value="{{ request('location') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Thành phố...">
                    </div>

                    <!-- Price Range -->
                    <div class="mb-5">
                        <label class="block text-gray-700 font-medium mb-2">Giá phòng ($)</label>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Từ">
                            <input type="number" name="max_price" value="{{ request('max_price') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Đến">
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="mb-5">
                        <label class="block text-gray-700 font-medium mb-2">Đánh giá</label>
                        @foreach([5, 4, 3] as $star)
                        <label class="flex items-center mb-2 cursor-pointer">
                            <input type="checkbox" name="rating[]" value="{{ $star }}"
                                {{ in_array($star, (array)request('rating', [])) ? 'checked' : '' }}
                                class="mr-2">
                            <div class="flex text-yellow-400">
                                @for($i = 0; $i < $star; $i++)
                                    <i class="fas fa-star text-sm"></i>
                                @endfor
                            </div>
                            <span class="text-gray-600 text-sm ml-1">{{ $star }} sao</span>
                        </label>
                        @endforeach
                    </div>

                    <!-- Amenities -->
                    <div class="mb-5">
                        <label class="block text-gray-700 font-medium mb-2">Tiện nghi</label>
                        @foreach($amenities as $amenity)
                        <label class="flex items-center mb-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                                {{ in_array($amenity->id, (array)request('amenities', [])) ? 'checked' : '' }}
                                class="mr-2">
                            <span class="text-gray-600 text-sm">{{ $amenity->icon }} {{ $amenity->name }}</span>
                        </label>
                        @endforeach
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
                        <i class="fas fa-search mr-2"></i>Tìm kiếm
                    </button>
                    <a href="{{ route('hotels.search') }}"
                        class="block text-center text-gray-500 hover:text-gray-700 text-sm mt-2">
                        Xóa bộ lọc
                    </a>
                </form>
            </div>
        </div>

        <!-- Hotel List -->
        <div class="flex-1">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">
                    Tìm thấy <span class="text-blue-600">{{ $hotels->total() }}</span> khách sạn
                </h2>
                <select name="sort" onchange="this.form.submit()"
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="rating-desc" {{ request('sort') == 'rating-desc' ? 'selected' : '' }}>Đánh giá cao nhất</option>
                    <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Giá thấp nhất</option>
                    <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Giá cao nhất</option>
                </select>
            </div>

            <!-- Hotels Grid -->
            @forelse($hotels as $hotel)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden mb-6">
                <div class="flex">
                    <!-- Image -->
                    <img src="{{ $hotel->main_image ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop' }}"
                        alt="{{ $hotel->name }}"
                        class="w-64 h-48 object-cover flex-shrink-0">

                    <!-- Content -->
                    <div class="p-5 flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $hotel->name }}</h3>
                                <p class="text-gray-500 text-sm mt-1">
                                    <i class="fas fa-map-marker-alt mr-1 text-blue-500"></i>
                                    {{ $hotel->address }}, {{ $hotel->city }}
                                </p>
                            </div>
                            <div class="flex items-center bg-blue-600 text-white px-3 py-1 rounded-lg">
                                <i class="fas fa-star text-yellow-300 text-sm mr-1"></i>
                                <span class="font-bold">{{ number_format($hotel->rating, 1) }}</span>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mt-3 line-clamp-2">{{ $hotel->description }}</p>

                        <!-- Amenities -->
                        <div class="flex flex-wrap gap-2 mt-3">
                            @foreach($hotel->amenities->take(4) as $amenity)
                            <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">
                                {{ $amenity->icon }} {{ $amenity->name }}
                            </span>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <div>
                                <span class="text-gray-400 text-sm">Từ</span>
                                <span class="text-blue-600 font-bold text-xl ml-1">
                                    ${{ number_format($hotel->rooms->min('price_per_night') ?? 0) }}
                                </span>
                                <span class="text-gray-400 text-sm">/đêm</span>
                            </div>
                            <a href="{{ route('hotels.show', $hotel) }}"
                                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-16">
                <i class="fas fa-search text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-xl">Không tìm thấy khách sạn phù hợp</p>
                <a href="{{ route('hotels.search') }}" class="text-blue-600 hover:underline mt-2 inline-block">Xóa bộ lọc</a>
            </div>
            @endforelse

            <!-- Pagination -->
            <div class="mt-6">
                {{ $hotels->links() }}
            </div>
        </div>
    </div>
</div>
@endsection