<?php

namespace App\Contracts;

class UserConstants
{

    const TYPES = [
        UserConstants::ADMIN,
        UserConstants::CUSTOMER,
    ];

    const ADMIN = 'admin';
    const CUSTOMER = 'customer';
}