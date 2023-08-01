<?php

namespace Awcodes\FilamentGravatar;

use Filament\AvatarProviders\Contracts\AvatarProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class GravatarProvider implements AvatarProvider
{
    public function get(Model | Authenticatable $record): string
    {
        return Gravatar::get(email: $record->email);
    }
}
