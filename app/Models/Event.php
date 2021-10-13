<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $with = ['calendar'];
    protected $fillable = ['google_id', 'title', 'description', 'allday', 'start', 'end'];

    public function calendar()
    {
        return $this->belongsTo(Calendar::class, 'idCalendar', 'id');
    }
    
    public function getStartedAtAttribute($start)
    {
        return $this->asDateTime($start)->setTimezone($this->calendar->timezone);
    }
    
    public function getEndedAtAttribute($end)
    {
        return $this->asDateTime($end)->setTimezone($this->calendar->timezone);
    }
    
    public function getDurationAttribute()
    {
        return $this->start->diffForHumans($this->end, true);
    }
    
}
