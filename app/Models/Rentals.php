<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rentals extends Model
{
    use HasFactory;

    protected $fillable = [
        'carId',      // Foreign key referencing the Cars table
        'userId',     // Foreign key referencing the Users table
        'approvedBy',     // Foreign key referencing the Users table
        'start_date',  // Rental start date
        'end_date',    // Rental end date
        'price',       // Price for the rental
        'status',      // Status of the rental (e.g., booked, completed, canceled)
        'approve',      // Status of the rental (e.g., booked, completed, canceled)
        'remarks',      // Status of the rental (e.g., booked, completed, canceled)
    ];

    // Define relationships, if needed
     public function car()
    {
        return $this->belongsTo(Cars::class, 'carId'); // Specify the foreign key
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'userId'); // Specify the foreign key
    }
}
