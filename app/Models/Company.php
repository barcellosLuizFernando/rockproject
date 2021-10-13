<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function city()
    {
        # code...
        return $this->belongsTo(City::class, 'idCity', 'id');
    }
}
