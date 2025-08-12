<?php

declare(strict_types=1);

namespace Awcodes\Gravatar\Enums;

enum Rating: string
{
    case G = 'g';
    case PG = 'pg';
    case R = 'r';
    case X = 'x';
}
