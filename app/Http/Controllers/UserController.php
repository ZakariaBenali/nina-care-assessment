<?php

namespace App\Http\Controllers;

use App\Filters\User\AgeFilter;
use App\Filters\User\GenderFilter;
use App\Filters\User\ReligionFilter;
use \App\Filters\User\NameFilter;

use App\Models\User;
use Illuminate\Pipeline\Pipeline;

class UserController extends Controller
{
    /**
     * Display a listing of user.
     */
    public function index()
    {
        $users = app(Pipeline::class)
                    ->send(User::query())
                    ->through([
                        NameFilter::class,
                        GenderFilter::class,
                        ReligionFilter::class,
                        AgeFilter::class,
                    ])
                    ->thenReturn()
                    ->get();
        return $users;
    }
}
