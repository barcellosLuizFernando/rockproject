<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    use HasFactory;

    public function financeplan()
    {
        # code...
        return $this->belongsTo(Financeplan::class, 'idFinancePlan', 'id');
    }
}
