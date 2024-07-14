<?php

use Carbon\Carbon;

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'd-m-Y H:i:s')
    {
        return Carbon::parse($date)->format($format);
    }
}
