<?php

namespace App\Enums;

use App\Enums\Traits\ToArrayTrait;

enum RoleEnum: string
{
    use ToArrayTrait;

    case ADMIN = 'admin';
    case REGULAR = 'regular';
}
