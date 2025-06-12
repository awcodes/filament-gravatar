<?php

declare(strict_types=1);

use Awcodes\Gravatar\GravatarPlugin;
use Awcodes\Gravatar\GravatarProvider;
use Awcodes\Gravatar\Tests\Fixtures\Models\User;
use Filament\Facades\Filament;

beforeEach(function () {
    $this->panel = Filament::getCurrentOrDefaultPanel();
});

it('can generate a gravatar URL', function () {
    $this->panel
        ->plugins([
            GravatarPlugin::make()
                ->default('robohash')
                ->size(200)
                ->rating('pg'),
        ]);

    $user = User::factory()->create([
        'email' => 'test@example.com',
    ])->refresh();

    $url = (new GravatarProvider)->get($user);

    expect($url)->toBe('https://www.gravatar.com/avatar/55502f40dc8b7c769880b10874abc9d0?s=200&d=robohash&r=pg');
});
