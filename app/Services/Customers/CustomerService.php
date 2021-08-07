<?php

namespace App\Services\Customers;

use App\Repositories\Users\UserRepo;
use App\Helpers\DateHelper;
class CustomerService
{
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getCustomers($data)
    {
        if (isset($data['id']) && $data['id']) {
            $id = $data['id'];
        }
        if (isset($data['first_name']) && $data['first_name']) {
            $firstName = $data['first_name'];
        }
        if (isset($data['email']) && $data['email']) {
            $email = $data['email'];
        }
        if (isset($data['pagination']) && $data['pagination']) {
            $pagination = $data['pagination'];
        }

        return $this->userRepo->getCustomers($id ?? null, $firstName ?? null, $email ?? null, $pagination ?? null);
    }

    public function getAverageRegistration($data)
    {
        $data['period'] = DateHelper::getPeriod($data['period']);
        
        return $this->userRepo->getAverageRegistration($data['period']);
    }
}