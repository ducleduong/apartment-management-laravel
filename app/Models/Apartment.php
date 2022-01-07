<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $table = 'apartment';
    protected $hidden = ['apartment_areas_id'];
    protected $fillable = [
        'id',
        'price',
        'area',
        'rooms',
        'apartment_areas_id'
    ];

   public function apartment_areas() {
       return $this->hasOne(ApartmentAreas::class, 'id');
   }

}
