@extends('admin.layouts.app')

@section('title', 'Thêm khách sạn - Admin')
@section('page-title', 'Thêm khách sạn mới')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl shadow-md p-6">
        <form action="{{ route('admin.hotels.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <!-- Name -->
                <div class="col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Tên khách sạn <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                        placeholder="Grand Hotel...">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Mô tả</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Mô tả về khách sạn...">{{ old('description') }}</textarea>
                </div>

                <!-- Address -->
                <div class="col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Địa chỉ <span class="text-red-500">*</span></label>
                    <input type="text" name="address" value="{{ old('address') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror"
                        placeholder="123 Nguyễn Huệ...">
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Thành phố <span class="text-red-500">*</span></label>
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('city') border-red-500 @enderror"
                        placeholder="Hà Nội">
                    @error('city')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Province -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tỉnh/Thành <span class="text-red-500">*</span></label>
                    <input type="text" name="province" value="{{ old('province') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('province') border-red-500 @enderror"
                        placeholder="Hà Nội">
                    @error('province')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Số điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="+84 24 1234 5678">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="hotel@example.com">
                </div>

                <!-- Main Image -->
                <div class="col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">URL Hình ảnh chính</label>
                    <input type="url" name="main_image" value="{{ old('main_image') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="https://...">
                </div>

                <!-- Is Active -->
                <div class="col-span-2">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600">
                        <span class="text-gray-700 font-medium">Kích hoạt khách sạn</span>
                    </label>
                </div>

                <!-- Amenities -->
                <div class="col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Tiện nghi</label>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach($amenities as $amenity)
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                                {{ in_array($amenity->id, (array)old('amenities', [])) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600">
                            <span class="text-gray-600 text-sm">{{ $amenity->icon }} {{ $amenity->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mt-6 pt-6 border-t">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium transition duration-200">
                    <i class="fas fa-save mr-2"></i>Lưu khách sạn
                </button>
                <a href="{{ route('admin.hotels.index') }}"
                    class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 font-medium transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Quay lại
                </a>
            </div>
        </form>
    </div>
</div>
@endsection