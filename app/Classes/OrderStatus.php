<?php

namespace App\Classes;

enum OrderStatus: int
{
    case Wait = 1;
    case Accept = 2;
    case Process = 3;
    case Received = 4;

}
