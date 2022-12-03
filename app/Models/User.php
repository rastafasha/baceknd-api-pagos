<?php

namespace App\Models;

use App\Jobs\NewUserRegisterJob;
use App\Traits\ManagePermission;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, ManagePermission;
    /*
    |--------------------------------------------------------------------------
    | goblan variables
    |--------------------------------------------------------------------------
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'is_active'
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
    ];

    /*
    |--------------------------------------------------------------------------
    | functions
    |--------------------------------------------------------------------------
    */

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
            return [];
    }

    protected static function boot(){

        parent::boot();

        static::created(function($user){

            NewUserRegisterJob::dispatch(
                $user
            )->onQueue("high");
        });

    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function directories(){
        return $this->hasMany(Directory::class, 'user_id');
    }

    public function pagos(){
        return $this->hasMany(Pagos::class, 'user_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}