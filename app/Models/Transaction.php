<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    public function purchases()
    {
        # code...
        return $this->hasMany(Purchase::class, 'idTransaction', 'id');
    }

    public function payments()
    {
        # code...

        return $this->hasMany(Payment::class, 'idTransaction', 'id');
    }

    public function sales()
    {
        # code...

        return $this->hasMany(Sale::class, 'idTransaction', 'id');
    }

    public function receivables()
    {
        # code...

        return $this->hasMany(Receivable::class, 'idTransaction', 'id');
    }
}
