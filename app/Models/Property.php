<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'image',
        'video',
        'location_latitude',
        'location_longitude',
        'city',
        'city_slug',
        'featured',
        'status',
        'user_id',
        'category_id',
        'activity_type',
        'difficulty_level',
        'start_time',
        'end_time',
        'duration',
        'max_participants',
        'min_participants',
        'meeting_point',
        'included_items',
        'excluded_items',
        'cancellation_policy',
        'nearby',
        'date',
        'target',
        'price_with_tshirt',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'featured' => 'boolean',
        'status' => 'boolean',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'included_items' => 'array',
        'excluded_items' => 'array',
        'date' => 'date',
        'price_with_tshirt' => 'double',
    ];

    /**
     * Get the user that owns the property.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the property.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the features for the property.
     */
    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }

    /**
     * Get the comments for the property.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the ratings for the property.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
} 