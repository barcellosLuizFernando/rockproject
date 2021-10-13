<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleAccount extends Model
{
    use HasFactory;

    protected $fillable = ['google_id', 'name', 'token'];
    protected $casts = ['token' => 'json'];

    public function calendars()
    {
        # code...
        return $this->hasMany(Calendar::class);
    }
}
