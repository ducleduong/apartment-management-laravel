<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentAreas extends Model
{
    use HasFactory;
    protected $table = 'apartment_areas';
    protected $fillable = [
        'name',
        'floors',
        'address'
    ];

    public function apartments() {
        return $this->hasMany(Apartment::class);
    }
}
