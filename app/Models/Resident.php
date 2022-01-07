<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;
    protected $table = 'resident';
    
    public function contracts() {
        return $this->hasMany(Contract::class);
    }
}
