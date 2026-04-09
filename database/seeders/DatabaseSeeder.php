<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Amenity;
use App\Models\Booking;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@hotelhub.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);

        // Create regular user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@hotelhub.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_admin' => false,
        ]);

        // Create amenities
        $amenities = [
            ['name' => 'WiFi', 'icon' => '📶', 'category' => 'Room'],
            ['name' => 'Swimming Pool', 'icon' => '🏊', 'category' => 'Facility'],
            ['name' => 'Gym', 'icon' => '💪', 'category' => 'Facility'],
            ['name' => 'Parking', 'icon' => '🚗', 'category' => 'Service'],
            ['name' => 'Restaurant', 'icon' => '🍽️', 'category' => 'Facility'],
            ['name' => 'Spa', 'icon' => '🧘', 'category' => 'Facility'],
            ['name' => 'Airport Shuttle', 'icon' => '🚐', 'category' => 'Service'],
            ['name' => '24/7 Reception', 'icon' => '🛎️', 'category' => 'Service'],
        ];

        $amenityModels = collect();
        foreach ($amenities as $amenity) {
            $amenityModels->push(Amenity::create($amenity));
        }

        // Create hotels
        $hotels = [
            [
                'name' => 'Grand Hotel Hanoi',
                'description' => 'Khách sạn 5 sao sang trọng tại trung tâm Hà Nội, gần Hồ Hoàn Kiếm và phố cổ.',
                'address' => '123 Nguyễn Du, Hoàn Kiếm',
                'city' => 'Hà Nội',
                'province' => 'Hà Nội',
                'phone' => '+84 24 3824 5678',
                'email' => 'info@grandhanoi.com',
                'latitude' => 21.0285,
                'longitude' => 105.8542,
                'rating' => 4.5,
                'main_image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop',
            ],
            [
                'name' => 'Saigon Riverside Hotel',
                'description' => 'Khách sạn hiện đại bên bờ sông Sài Gòn, view đẹp, tiện nghi đầy đủ.',
                'address' => '456 Nguyễn Huệ, Quận 1',
                'city' => 'TP. Hồ Chí Minh',
                'province' => 'TP. Hồ Chí Minh',
                'phone' => '+84 28 3829 1234',
                'email' => 'contact@saigonriverside.com',
                'latitude' => 10.7769,
                'longitude' => 106.7009,
                'rating' => 4.8,
                'main_image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800&h=600&fit=crop',
            ],
            [
                'name' => 'Da Nang Beach Resort',
                'description' => 'Resort nghỉ dưỡng ven biển Đà Nẵng, hồ bơi vô cực, bãi biển riêng.',
                'address' => '789 Bạch Đằng, Sơn Trà',
                'city' => 'Đà Nẵng',
                'province' => 'Đà Nẵng',
                'phone' => '+84 236 3890 567',
                'email' => 'reservations@danangbeach.com',
                'latitude' => 16.0544,
                'longitude' => 108.2022,
                'rating' => 4.6,
                'main_image' => 'https://images.unsplash.com/photo-1571008887538-b36bb32f4571?w=800&h=600&fit=crop',
            ],
            [
                'name' => 'Halong Bay View Hotel',
                'description' => 'Khách sạn view Vịnh Hạ Long tuyệt đẹp, nhà hàng buffet đa dạng.',
                'address' => '321 Bãi Cháy, Hạ Long',
                'city' => 'Hạ Long',
                'province' => 'Quảng Ninh',
                'phone' => '+84 203 3847 890',
                'email' => 'info@halongview.com',
                'latitude' => 20.9101,
                'longitude' => 107.1839,
                'rating' => 4.4,
                'main_image' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?w=800&h=600&fit=crop',
            ],
            [
                'name' => 'Hue Imperial Hotel',
                'description' => 'Khách sạn cổ kính phong cách Huế, gần Đại Nội và các di tích lịch sử.',
                'address' => '654 Lê Lợi, Thành phố Huế',
                'city' => 'Huế',
                'province' => 'Thừa Thiên Huế',
                'phone' => '+84 234 3823 456',
                'email' => 'contact@hueimperial.com',
                'latitude' => 16.4637,
                'longitude' => 107.5909,
                'rating' => 4.7,
                'main_image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop',
            ],
            [
                'name' => 'Nha Trang Ocean Villa',
                'description' => 'Villa nghỉ dưỡng cao cấp tại Nha Trang, view biển, hồ bơi riêng.',
                'address' => '987 Trần Phú, Nha Trang',
                'city' => 'Nha Trang',
                'province' => 'Khánh Hòa',
                'phone' => '+84 258 3521 234',
                'email' => 'reservations@nhatrangvilla.com',
                'latitude' => 12.2388,
                'longitude' => 109.1967,
                'rating' => 4.5,
                'main_image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800&h=600&fit=crop',
            ],
        ];

        $hotelModels = [];
        foreach ($hotels as $hotelData) {
            $hotel = Hotel::create($hotelData);

            // Attach random amenities
            $randomAmenities = $amenityModels->random(min(rand(4, 6), $amenityModels->count()));
            $hotel->amenities()->attach($randomAmenities->pluck('id'));

            // Create rooms
            $roomTypes = [
                ['name' => 'Phòng Đơn', 'type' => 'Single', 'guests' => 1, 'bed' => '1 Single Bed', 'price' => 50],
                ['name' => 'Phòng Đôi Deluxe', 'type' => 'Double', 'guests' => 2, 'bed' => '1 King Bed', 'price' => 85],
                ['name' => 'Phòng Đôi Superior', 'type' => 'Double', 'guests' => 2, 'bed' => '2 Twin Beds', 'price' => 90],
                ['name' => 'Suite', 'type' => 'Suite', 'guests' => 4, 'bed' => '1 King Bed + Sofa', 'price' => 150],
            ];

            foreach ($roomTypes as $roomData) {
                Room::create([
                    'hotel_id' => $hotel->id,
                    'name' => $roomData['name'],
                    'description' => "Phòng {$roomData['name']} với {$roomData['bed']}, tối đa {$roomData['guests']} khách.",
                    'room_type' => $roomData['type'],
                    'max_guests' => $roomData['guests'],
                    'size_sqm' => rand(20, 50),
                    'bed_type' => $roomData['bed'],
                    'price_per_night' => $hotel->rating > 4.5 ? $roomData['price'] + 10 : $roomData['price'],
                    'total_rooms' => rand(3, 8),
                    'amenities' => ['WiFi', 'TV', 'AC', 'Mini Bar'],
                    'image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=600&h=400&fit=crop',
                ]);
            }

            // Create reviews
            for ($i = 0; $i < rand(10, 20); $i++) {
                Review::create([
                    'user_id' => $user->id,
                    'hotel_id' => $hotel->id,
                    'rating' => rand(4, 5),
                    'comment' => 'Khách sạn rất đẹp, phòng sạch sẽ, nhân viên nhiệt tình. Tôi sẽ quay lại!',
                    'is_verified' => true,
                    'is_published' => true,
                ]);
            }

            $hotel->updateRating();
            $hotelModels[] = $hotel;
        }

        // Create bookings
        foreach ($hotelModels as $hotel) {
            $room = $hotel->rooms->random();
            $checkIn = now()->addDays(rand(7, 30));
            $checkOut = $checkIn->copy()->addDays(rand(2, 5));
            $nights = $checkIn->diffInDays($checkOut);
            $subtotal = $room->price_per_night * $nights;
            $taxes = $subtotal * 0.1;
            $serviceFee = 15;
            $total = $subtotal + $taxes + $serviceFee;

            Booking::create([
                'user_id' => $user->id,
                'hotel_id' => $hotel->id,
                'room_id' => $room->id,
                'check_in_date' => $checkIn->format('Y-m-d'),
                'check_out_date' => $checkOut->format('Y-m-d'),
                'number_of_guests' => rand(1, min(4, $room->max_guests)),
                'number_of_nights' => $nights,
                'room_price_per_night' => $room->price_per_night,
                'subtotal' => $subtotal,
                'taxes' => $taxes,
                'service_fee' => $serviceFee,
                'total_amount' => $total,
                'guest_name' => $user->name,
                'guest_email' => $user->email,
                'status' => collect(['confirmed', 'confirmed', 'confirmed', 'pending'])->random(),
            ]);
        }
    }
}