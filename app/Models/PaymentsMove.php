<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsMove extends Model
{
    use HasFactory;

    public function payment()
    {
        # code...
        return $this->belongsTo(Payment::class,'idPayment', 'id');
    }

    public function transaction()
    {
        # code...
        return $this->belongsTo(Transaction::class, 'idTransaction', 'id');
    }
}
