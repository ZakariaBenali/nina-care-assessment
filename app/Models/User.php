<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;


class User extends Authenticatable
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
        'job',
        'age',
        'location',
        'marital_status',
        'gender',
        'religion'
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


    public function posts():HasMany {
        return $this->hasMany(Post::class);
    }

    public function scopeFilter(Builder $builder) {
        $builder->when(request()->has('gender'), function($query) {
            return $query->ofGender(request()->gender);
        });

        $builder->when(request()->has('minAge') || request()->has('maxAge'), function($query) {
            return $query->ageBetween(request()->minAge, request()->maxAge);
        });

        $builder->when(request()->has('name'), function($query) {
            return $query->named(request()->name);
        });

        $builder->when(request()->has('name'), function($query) {
            return $query->named(request()->name);
        });

        $builder->when(request()->has('post_title'), function($query) {
            return $query->postTile(request()->post_title);
        });
    }

    public function scopeOfGender(Builder $query, string $gender) {
        $query->where('gender', $gender);
    }

    public function scopeAgeBetween(Builder $query, int $minAge, int $maxAge) {
        $query->whereBetween('age', [$minAge, $maxAge]);
    }

    public function scopeNamed(Builder $query, string $name) {
        $query->where('name','LIKE',"%$name%");
    }

    public function scopePostTile(Builder $query, string $keyword) {
        $query->whereRelation('posts', 'title', 'LIKE', "%$keyword%");
    }
}
