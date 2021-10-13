<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courseclass extends Model
{
    use HasFactory;

    public function company()
    {
        # code...
        return $this->belongsTo(Company::class, 'idCompany', 'id');
    }

    public function classlocal()
    {
        # code...
        return $this->belongsTo(Classlocal::class, 'idClassLocal', 'id');
    }

    public function course()
    {
        # code...
        return $this->belongsTo(Course::class, 'idCourse', 'id');
    }
}
