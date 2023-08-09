<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'users';
    // Rest omitted for brevity
    protected $fillable = [
        'id',
        'email',
        'username',
        'password',
        'salt',
        'birthday',
        'create_at',
        'update_at',
        'mac_address',
        'regist_at',
        'months_regist',
        'deleted_at',
        'address',
        'is_admin',
        'phone'
    ];
    protected $hidden = [
        'password',
        'salt',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
        /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_deleted' => 'boolean'
    ];

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
    public function regist()
    {
        
    }
}
