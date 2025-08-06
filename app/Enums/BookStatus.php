<?php

namespace App\Enums;

enum BookStatus: string
{
    case AVAILABLE = 'موجود';
    case LENT = 'امانت داده شده';
}
