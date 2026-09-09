<?php

declare(strict_types=1);

namespace Awcodes\Gravatar;

use Filament\AvatarProviders\Contracts\AvatarProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class GravatarProvider implements AvatarProvider
{
    public function get(Model | Authenticatable $record): string
    {
        $email = data_get($record, 'email');

        return Gravatar::get(
            email: is_string($email) ? $email : null,
            size: GravatarPlugin::get()->getSize(),
            default: GravatarPlugin::get()->getDefault(),
            rating: GravatarPlugin::get()->getRating(),
        );
    }
}
