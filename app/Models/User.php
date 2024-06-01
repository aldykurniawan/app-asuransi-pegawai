<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * ungarder.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
        'password'          => 'hashed',
    ];

    public static $withoutAppends = false;

    protected $appends = ['level'];

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'users_index';
    }

    public function toSearchableArray()
    {
        return [
            'name'     => $this->name,
            'email'    => $this->email,
            'username' => $this->username,
        ];
    }

    /**
     * get level first.
     *
     * @return string|null
     */
    public function getLevelAttribute()
    {
        $roles = $this->roles->pluck('name');

        return count($roles) > 0 ? $roles[0] : null;
    }

    /**
     * get permission dalam bentuk array.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getPermissionArray()
    {
        return $this->getAllPermissions()->mapWithKeys(function ($pr) {
            return [$pr['name'] => true];
        });
    }

    /**
     * get role dalam bentuk array.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRoleArray()
    {
        return $this->getRoleNames()->mapWithKeys(function ($pr) {
            return [$pr => true];
        });
    }
}
