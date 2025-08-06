<?php

namespace App\Enums;
enum UserRole: string
{
    case MEMBER = 'عضو';
    case LIBRARIAN = 'کتابدار';
    case ADMINISTRATOR = 'مدیریت';
}
