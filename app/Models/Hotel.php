<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'province',
        'country',
        'phone',
        'email',
        'website',
        'latitude',
        'longitude',
        'rating',
        'review_count',
        'main_image',
        'images',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'rating' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'hotel_amenities');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function updateRating()
    {
        $avgRating = $this->reviews()->where('is_published', true)->avg('rating');
        $reviewCount = $this->reviews()->where('is_published', true)->count();

        $this->update([
            'rating' => round($avgRating ?? 0, 2),
            'review_count' => $reviewCount,
        ]);
    }
}