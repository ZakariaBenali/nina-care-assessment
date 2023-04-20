<?php
namespace App\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\FilterInterface;
use Closure;

class ReligionFilter implements FilterInterface {

    public function handle(Builder $query, Closure $next) {
        if(request()->has('religion')) {
            $religion = request()->religion;
            $query->where('religion',$religion);
        }
        return $next($query);
    }
}
