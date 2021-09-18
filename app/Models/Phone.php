<?php

namespace App\Models;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'number',
        'person_id',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
