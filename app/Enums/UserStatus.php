<?php

namespace App\Enums;

enum UserStatus: string
{
    case NEW = 'new';
    case EXISTS = 'exists';
}
