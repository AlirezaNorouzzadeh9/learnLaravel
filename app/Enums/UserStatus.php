<?php

namespace App\Enums;


enum UserStatus : string
{
    case Active = 'active';
    case In_active = 'in_active';
    case Banned = 'banned';
}