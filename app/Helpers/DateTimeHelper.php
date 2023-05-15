<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateTimeHelper
{
    public static function separateDateTime($datetime)
    {
        $carbonDateTime = Carbon::parse($datetime);
        return [
            'date' => $carbonDateTime->format('Y-m-d'),
            'time' => $carbonDateTime->format('H:i'),
        ];
    }
}
