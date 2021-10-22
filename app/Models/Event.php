<?php

namespace App\Models;

use App\Models\Person;
use App\Models\Point;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getCreatedAtAttribute($created_at)
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($created_at);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
    }

    public function points()
    {
        return $this->belongsToMany(Point::class, 'event_point');
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'event_person');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
