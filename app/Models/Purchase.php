<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function supplier()
    {
        # code...
        return $this->belongsTo(People::class, 'idSupplier', 'id');
    }

    public function payments()
    {
        # code...
        return $this->hasMany(Payment::class,'idPurchase','id');
    }
}
