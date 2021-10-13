<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = ['google_id', 'name', 'color', 'timezone'];

    public function googleAccount()
    {
        # code...
        return $this->belongsTo(GoogleAccount::class);
    }

    public function events()
    {
        # code...
        return $this->hasMany(Event::class);

        
    }
}
