<?php
namespace App\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\FilterInterface;
use Closure;

class GenderFilter implements FilterInterface {

    public function handle(Builder $query, Closure $next) {
        if(request()->has('gender')) {
            $gender = request()->gender;
            $query->where('gender', $gender);
        }
        return $next($query);
    }
}
