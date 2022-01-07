<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;
    protected $table = 'resident';
    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        "phone_number",
        "identity_card_number",
        "country",
        "gender"
    ];
    
    public function contracts() {
        return $this->hasMany(Contract::class);
    }
}
