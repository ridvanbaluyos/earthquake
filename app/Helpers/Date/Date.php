<?php

namespace App\Helpers\DateHelper;

class DateHelper
{
    public static function convertDate($date, $timezone = 'Asia/Manila')
    {
        // TODO: fix
        // converting to GMT+8
        $date = date('Y-m-d H:i:s', (intval($date) / 1000) + 8 * 3600); // +8hrs

        return $date;
    }
}