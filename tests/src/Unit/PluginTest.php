<?php

declare(strict_types=1);

use Awcodes\Gravatar\Enums\Defaults;
use Awcodes\Gravatar\Enums\Rating;
use Awcodes\Gravatar\Gravatar;
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

it('accepts every Defaults enum case, including mp', function (Defaults $case) {
    $this->panel->plugins([
        GravatarPlugin::make()->default($case),
    ]);

    expect(Filament::getPlugin('awcodes/gravatar')->getDefault())->toBe($case->value);
})->with(Defaults::cases());

it('accepts the string value of every Defaults enum case', function (Defaults $case) {
    $this->panel->plugins([
        GravatarPlugin::make()->default($case->value),
    ]);

    expect(Filament::getPlugin('awcodes/gravatar')->getDefault())->toBe($case->value);
})->with(Defaults::cases());

it('falls back to a default that is a valid enum case', function () {
    $this->panel->plugins([GravatarPlugin::make()]);

    $plugin = Filament::getPlugin('awcodes/gravatar');

    expect(Defaults::tryFrom($plugin->getDefault()))->not->toBeNull()
        ->and(Rating::tryFrom($plugin->getRating()))->not->toBeNull();
});

it('rejects an unknown default', function () {
    GravatarPlugin::make()->default('not-a-real-default');
})->throws(Exception::class, 'Invalid Gravatar default');

it('rejects a size outside the allowed bounds', function (int $size) {
    GravatarPlugin::make()->size($size);
})->with([Gravatar::MIN_SIZE - 1, Gravatar::MAX_SIZE + 1])->throws(Exception::class);

it('accepts sizes at the bounds', function (int $size) {
    $this->panel->plugins([GravatarPlugin::make()->size($size)]);

    expect(Filament::getPlugin('awcodes/gravatar')->getSize())->toBe($size);
})->with([Gravatar::MIN_SIZE, Gravatar::MAX_SIZE]);
