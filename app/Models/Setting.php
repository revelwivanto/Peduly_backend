<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'footer',
        'aboutus',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
        'instagram',
        'logo',
        'favicon',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
} 