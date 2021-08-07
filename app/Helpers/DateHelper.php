<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Contracts\DateConstants;

class DateHelper
{
    public static function getPeriod($period)
    {
        return Carbon::now()->sub(DateConstants::PERIODS[$period]);
    }
}