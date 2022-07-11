<?php

namespace FilamentGravatar;

use Illuminate\Database\Eloquent\Model;
use Filament\AvatarProviders\Contracts\AvatarProvider;

class UiAvatarsProvider implements AvatarProvider
{
    public function get(Model $user): string
    {
        return Gravatar::get($user->email);
    }
}
