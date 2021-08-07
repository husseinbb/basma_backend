<?php

namespace App\Contracts;

class DateConstants
{
    const PERIODS = [
        DateConstants::LAST_24_HOURS => '1 day',
        DateConstants::LAST_WEEK => '1 week',
        DateConstants::LAST_3_MONTHS => '3 month',
        DateConstants::LAST_MONTH => '1 month',
        DateConstants::LAST_YEAR => '1 year',
    ];

    const LAST_24_HOURS = 'last_24_hours';
    const LAST_WEEK = 'last_week';
    const LAST_MONTH = 'last_month';
    const LAST_3_MONTHS = 'last_3_months';
    const LAST_YEAR = 'last_year';
}