<?php

namespace App\Models;

use App\Models\Classification;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'classification_id',
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
}
