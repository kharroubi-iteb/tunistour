<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommercialPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'destination_id',
        'type', // 'hotel' or 'restaurant'
        'price',
        'rating',
        'description',
        'image_url'
    ];

    protected $casts = [
        'rating' => 'float',
    ];

    /**
     * Un commerce appartient à un lieu touristique unique
     */
    public function lieu()
    {
        return $this->belongsTo(Lieu::class, 'destination_id');
    }
}
