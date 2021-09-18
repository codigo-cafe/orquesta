<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orchestra extends Model
{
    use HasFactory;
    public $table = "orchestra";
    protected $fillable = [
        'name',
        'description',
        'mission',
        'vission',
        'email',
        'phone',
        'direction',
        'banner',
        'latitude',
        'longitude',
        'iframe',
    ];
}
