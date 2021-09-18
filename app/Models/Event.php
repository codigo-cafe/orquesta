<?php

namespace App\Models;

use App\Models\Person;
use App\Models\Point;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'date',
        'start_time',
        'end_time',
        'place',
        'cover',
        'slug',
        'status',
        'category_id',
        'promotion_id',
        'user_id',
    ];

    public function points()
    {
        return $this->belongsToMany(Point::class, 'event_point');
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'event_person');
    }
}
