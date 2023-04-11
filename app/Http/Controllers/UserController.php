<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of user.
     */
    public function index()
    {
        return User::filter()->with('posts')->get();
    }
}
