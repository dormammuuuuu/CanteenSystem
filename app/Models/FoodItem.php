<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodItem extends Model
{
    use HasFactory;
    protected $collection = 'food_items';
    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'owner',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
