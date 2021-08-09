<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Contracts\UserConstants;

class UserRepo
{
    public function register($data)
    {
        return User::create($data);
    }

    public function getCustomers($id = null, $firstName = null, $email = null, $pagination = null)
    {
        return User::where('type', UserConstants::CUSTOMER)
                ->when($id, function($query) use($id) {
                    $query->where('id', $id);
                })
                ->when($firstName, function($query) use($firstName) {
                    $query->where('first_name', 'LIKE', '%' .$firstName. '%');
                })
                ->when($email, function($query) use($email) {
                    $query->where('email', $email);
                })
                ->paginate($pagination ?? 40);
    }

    public function getAverageRegistration($period)
    {
        return  User::selectRaw('date(created_at) as date, count(*) as count')
                ->where('type', UserConstants::CUSTOMER)
                ->where('created_at', '>=', $period)
                ->groupBy('date')
                ->get();
    }
}