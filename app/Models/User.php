<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   
     protected $fillable = [
        'address',
        'role',
        'fname',
        'sex',
        'phone',
        'email',
        'email_verified_at',
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'sex'      => 'boolean',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $appends = [
        'gender',
        'age',
    ];

    public function getAgeAttribute()
        {
            if ($this->dob) { return Carbon::parse($this->attributes['dob'])->age; };
        }
    public function getGenderAttribute()
        { 
            return $this->sex?'Male':'Female';
        }
     public function rentals()
    {
        return $this->hasMany(Rentals::class, 'userId'); // Specify the foreign key
    }
    // Relationship
    // public function role(){return $this->belongsTo(Role::class);} 
    // public function middlename(){return $this->belongsTo(Surname::class, 'mname_id');}
    // public function lastname(){return $this->belongsTo(Surname::class, 'lname_id');}
    // public function school(){return $this->belongsTo(School::class);}  
    // public function loads(){return $this->hasMany(Load::class, 'prof_id');}    

}
