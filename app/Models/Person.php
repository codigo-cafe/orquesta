<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Event;
use App\Models\Member;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;

class Person extends Model
{
    use HasFactory;
    use HasProfilePhoto;

    protected $fillable = [
        'name',
        'surnames',
        'profile_photo_path',
        'type_id',
        'status',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected function defaultProfilePhotoUrl()
    {
        $name = $this->name[0];
        $surnames =  $this->surnames[0];
        return 'https://ui-avatars.com/api/?name=' . urlencode($name . ' ' . $surnames) . '&color=7F9CF5&background=EBF4FF';
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_person');
    }
}
