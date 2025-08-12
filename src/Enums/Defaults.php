<?php

declare(strict_types=1);

namespace Awcodes\Gravatar\Enums;

enum Defaults: string
{
    case Initials = 'initials';
    case Color = 'color';
    case FourOhFour = '404';
    case Identicon = 'identicon';
    case Monsterid = 'monsterid';
    case Wavatar = 'wavatar';
    case Robohash = 'robohash';
}
