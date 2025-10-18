<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'family',
        'email',
        'password',
        'status',
        'phone',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            
        ];
    }

    public function scopeUserStatus($query,$status)
    {
        return $query->where('status',$status);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('status',function (Builder $builder){
            $builder->where('status',UserStatus::Active);
        });
    }


    public function getUserStatusAttribute()
{
    switch ($this->status) {
        case UserStatus::Active->value:
            return 'فعال';
        case UserStatus::In_active->value:
            return 'غیرفعال';
        default:
            return 'بن شده';
    }
}

public function getFullNameAttribute()
{
    return $this->name . ' '. $this->family;
}

public function setEmailAttribute($value)
{
     $this->attributes['email'] = strtolower($value);
}

public function userInfo()
{
    return $this->hasOne(UserInfo::class);
}

public function posts()
{
    return $this->hasMany(Post::class);
}

public function roles()
{
    return $this->belongsToMany(Role::class,'role_user');
}

}
