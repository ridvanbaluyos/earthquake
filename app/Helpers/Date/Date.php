<?php

namespace App\Helpers\DateHelper;

class DateHelper
{
    public static function convertDate($date, $timezone = 'Asia/Manila')
    {
        // TODO: fix
        // converting to GMT+8
        $date = date(DATE_RFC2822, (intval($date) / 1000) + 8 * 3600); // +8hrs

        return $date;
    }
}