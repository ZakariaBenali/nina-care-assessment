<?php
namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

interface FilterInterface {
    public function handle(Builder $query, Closure $next);
}
