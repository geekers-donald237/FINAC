<?php

namespace App\Models\user;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\armory\Armory;
use App\Models\armory\HoldersWeapon;
use App\Models\rule\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $keyType = 'string';


    public function armory()
    {
        return $this->hasOne(Armory::class);
    }



    public function getArmoryId()
    {
        if ($this->prefix === 'armory') {
            return $this->ressource_id;
        }

        return null;
    }

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'generated_password' => 'hashed',
    ];



}
