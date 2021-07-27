<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_name',
        'address1',
        'address2',
        'profile_uri',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'phone_no1',
        'phone_no2',
        'zip',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Client $client) {
            $client->attributes['start_validity'] = Carbon::now();
            $client->attributes['end_validity'] = Carbon::now()->addDays(15);
        });
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getActiveUsersAttribute()
    {
        return $this->users()->where('status', 'Active')->get()->count();
    }

    public function getInactiveUsersAttribute()
    {
        return $this->users()->where('status', 'Inactive')->get()->count();
    }

    public function getAllUsersAttribute()
    {
        return $this->users()->get()->count();
    }
}
