<?php

namespace App\Services\Auth;

use App\Repositories\Auth\UserRepo;

class RegisterService
{
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register($data)
    {
        return $this->userRepo->register($data);
    }
}