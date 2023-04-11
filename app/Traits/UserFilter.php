<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UserFilter
{
    public function scopeFilter(Builder $builder) {
        $builder->when(request()->has('gender'), function($query) {
            return $query->ofGender(request()->gender);
        });

        $builder->when(request()->has('minAge') || request()->has('maxAge'), function($query) {
            $minAge = request()->has('minAge') ? request()->minAge : 0;
            $maxAge = request()->has('maxAge') ? request()->maxAge : 150;
            return $query->ageBetween($minAge, $maxAge);
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
