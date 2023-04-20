<?php

namespace App\Http\Controllers;

use App\Actions\User\GetFilteredAction;

class UserController extends Controller
{
    /**
     * Display a listing of user.
     */
    public function index(GetFilteredAction $filteredAction)
    {
        $users = $filteredAction->execute();
        return $users;
    }
}
