<?php

namespace App\Utils;

class TimeCalculator
{


    static function secondsFromTime($time)
    {
        list($m, $s) = explode(':', $time);
        return ($m * 60) + $s;
    }

    static function timeFromSeconds($seconds)
    {
        $m = floor($seconds / 60);
        $s = ($seconds % 60);
        return sprintf('%02d:%02d', $m, $s);
    }

}
