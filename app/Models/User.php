<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\ResetPassword;
use Tymon\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'account_type', 'name', 'country', 'region', 'contact_address', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return bool
     */
    public function isActivated() {
        return $this->activated_at != null;
    }

    public function taskOrders() {
        return $this->hasMany(TaskOrder::class);
    }


    public function tasks() {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * return a token for activating user
     */
    public function getActivateToken() {
        config(['jwt.ttl' => config('auth.activate_ttl')]);
        $token = JWTAuth::fromUser($this);
//        $factory = app('tymon.jwt.payload.factory')->sub($this->email)->setTTL(config('auth.activate_ttl'));
//        $payload = $factory->make();
//        // $exp = $payload->getClaims()['exp'];
//        // $exp->setValue(time() + 7200);
//        $manager = app('tymon.jwt.manager');
//        $token = $manager->encode($payload)->get();
        return $token;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
