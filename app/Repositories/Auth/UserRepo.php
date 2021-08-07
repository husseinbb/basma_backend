<?php

namespace App\Repositories\Auth;
use App\Models\User;

class UserRepo
{
    public function register($data)
    {
        return User::create($data);
    }
}