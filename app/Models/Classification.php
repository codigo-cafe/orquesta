<?php

namespace App\Models;

use App\Models\Instrument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
    ];

    public function instruments()
    {
        return $this->hasMany(Instrument::class);
    }
}
