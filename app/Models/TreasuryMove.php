<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreasuryMove extends Model
{
    use HasFactory;

    public function transaction()
    {
        # code...
        return $this->belongsTo(Transaction::class, 'idTransaction', 'id');
    }
}
