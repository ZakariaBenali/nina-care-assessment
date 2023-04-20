<?php
namespace App\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\FilterInterface;
use Closure;

class NameFilter implements FilterInterface {

    public function handle(Builder $query, Closure $next) {
        if(request()->has('name')) {
            $name = request()->name;
            $query->where('name','LIKE',"%$name%");
        }
        return $next($query);
    }
}
