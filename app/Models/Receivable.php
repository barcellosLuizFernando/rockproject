<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receivable extends Model
{
    use HasFactory;

    public function client()
    {
        # code...
        return $this->belongsTo(People::class, 'idClient', 'id');
    }

    public function moves()
    {
        # code...
        return $this->hasMany(ReceivablesMove::class, 'idReceivable', 'id');
    }
}
