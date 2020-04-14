<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        return User::with('professor')->find($id);
    }
}
