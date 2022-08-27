<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'direction',
        'latitude',
        'longitude',
        'status',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_point');
    }
}
