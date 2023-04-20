<?php
namespace App\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\FilterInterface;
use Closure;

class AgeFilter implements FilterInterface {
    const MAX_AGE = 150;
    const MIN_AGE = 0;

    public function handle(Builder $query, Closure $next) {
        if(request()->has('maxAge') || request()->has('minAge')) {
            $minAge = request()->has('minAge') ? request()->minAge : self::MIN_AGE;
            $maxAge = request()->has('maxAge') ? request()->maxAge : self::MAX_AGE;
            $query->whereBetween('age', [$minAge, $maxAge]);
        }
        return $next($query);
    }
}
