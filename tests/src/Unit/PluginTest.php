<?php

declare(strict_types=1);

use Awcodes\Gravatar\GravatarPlugin;
use Awcodes\Gravatar\GravatarProvider;
use Filament\Facades\Filament;

beforeEach(function () {
    $this->panel = Filament::getCurrentOrDefaultPanel();
});

it('can register the plugin', function () {
    $this->panel
        ->plugins([
            GravatarPlugin::make(),
        ]);

    expect(Filament::getPlugin('awcodes/gravatar'))->toBeInstanceOf(GravatarPlugin::class);
});

it('can register the provider', function () {
    $this->panel
        ->defaultAvatarProvider(GravatarProvider::class)
        ->plugins([
            GravatarPlugin::make(),
        ]);

    expect(Filament::getDefaultAvatarProvider())
        ->toBe(GravatarProvider::class);
});

it('can register defaults', function () {
    $this->panel
        ->plugins([
            GravatarPlugin::make()
                ->default('robohash')
                ->size(200)
                ->rating('pg'),
        ]);

    $plugin = Filament::getPlugin('awcodes/gravatar');

    expect($plugin)
        ->getDefault()->toBe('robohash')
        ->and($plugin)->getSize()->toBe(200)
        ->and($plugin)->getRating()->toBe('pg');
});
