<?php

namespace App\Classes;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class PaginateHelper
{
    public const DEFAULT_COUNT = 5;

    public static function getPaginateNumber(?int $count = null)
    {
        if ($count) Session::put('paginate',$count);
        return Session::get('paginate',self::DEFAULT_COUNT);
    }
}
