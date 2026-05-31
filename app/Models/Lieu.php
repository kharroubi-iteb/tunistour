<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lieu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region',
        'description',
        'image_url',
        'category',
        'rating',
        'tags',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'tags' => 'array',
        'rating' => 'float',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /**
     * Un lieu possède plusieurs commerces associés (hôtels, restaurants...)
     */
    public function commercialPlaces()
    {
        return $this->hasMany(CommercialPlace::class);
    }
}
