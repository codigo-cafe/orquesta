<?php

namespace App\Models;

use App\Models\Instrument;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'orchestra_id',
        'person_id',
        'instrument_id',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }
}
