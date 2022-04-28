<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use TCG\Voyager\Models\Role;

/**
 * /**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $image
 * @property string $about
 * @property string $type
 * @property string $github
 * @property string $city
 * @property string $phone
 * @property string $birthday
 * @property int $role_id
 * @property int $department_id
 * @property int $position_id
 * @property string $adopted_at
 * @property string $login
 * @property int $is_finished
 * @property-read Department $department
 * @property-read Position $position
 */
class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'about',
        'type',
        'github',
        'city',
        'phone',
        'birthday',
        'role_id',
        'department_id',
        'position_id',
        'adopted_at',
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

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id','id');
    }

    public function position(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Position::class,'position_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
