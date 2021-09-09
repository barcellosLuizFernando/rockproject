<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function supplier()
    {
        # code...
        return $this->belongsTo(People::class, 'idSupplier', 'id');
    }

    public function paymentmoves()
    {
        return $this->hasMany(PaymentsMove::class, 'idPayment', 'id');
    }
}
