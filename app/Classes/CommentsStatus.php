<?php

namespace App\Classes;

enum CommentsStatus: int

{
    case New = 1;
    case NoReply = 2;
    case Replied = 3;
    case DeleteRequest = 4;
}
