<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id', 'license_plate', 'brand', 'model', 'color',
        'year', 'mileage', 'price', 'is_sold', 'views', 'image'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function isRecommended()
{
    // voorbeeldlogica: auto is aanbevolen als deze te koop is en minder dan 100 views heeft
    return !$this->is_sold && $this->views < 20;
}
}
