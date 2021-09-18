<?php

namespace App\Models;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'neighborhood',
        'streets',
        'number',
        'person_id',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
