<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
        'brand',
        'plateNum',
        'gas',
        'yearModel',
        'isActive',
        'price', // If you have a price field
    ];
     public function rentals()
    {
        return $this->hasMany(Rentals::class, 'carId'); // Specify the foreign key
    }
}
