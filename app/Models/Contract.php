<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contract';

    public function apartment() {
        $this->belongsTo(Apartment::class);
    }

    public function resident() {
        $this->belongsTo(Resident::class);
    }
}
