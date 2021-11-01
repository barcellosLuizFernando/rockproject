<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivablesMove extends Model
{
    use HasFactory;

    public function transaction()
    {
        # code...
        return $this->belongsTo(Transaction::class, 'idTransaction', 'id');
    }

    public function receivable()
    {
        # code...
        return $this->belongsTo(Receivable::class, 'idReceivable', 'id');
    }
}
