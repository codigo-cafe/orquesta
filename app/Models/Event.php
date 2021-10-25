<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Person;
use App\Models\Point;
use App\Models\Promotion;
use App\Models\User;
use Carbon\Carbon;
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCreatedAtAttribute($created_at)
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($created_at);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
    }

    public function getStartTimeAttribute($start_time)
    {
        return Carbon::parse($start_time)->format('H:i');
    }

    public function getEndTimeAttribute($end_time)
    {
        return Carbon::parse($end_time)->format('H:i');
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

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
