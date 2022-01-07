<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contract';
    protected $with = ['apartment'];

    public function apartment() {
        $this->hasOne(Apartment::class, 'id');
    }

    public function resident() {
        $this->hasMany(Resident::class, 'id');
    }
}
