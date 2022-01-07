<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $table = 'apartment';
    protected $fillable = [
        'id',
        'price',
        'area',
        'rooms',
        'apartment_areas_id'
    ];

   public function apartment_areas() {
       return $this->belongsTo(ApartmentAreas::class);
   }

}
