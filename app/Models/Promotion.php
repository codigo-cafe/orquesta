<?php

namespace App\Models;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'discount',
        'date_start',
        'date_end',
        'status',
    ];

    public function getDateStartAttribute($date)
    {
        return Carbon::create($date)->format('d/m/Y');
    }

    public function getDateEndAttribute($date)
    {
        return Carbon::create($date)->format('d/m/Y');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
