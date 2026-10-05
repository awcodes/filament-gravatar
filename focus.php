<?php

declare(strict_types=1);

use Awcodes\Focus\Card;
use Awcodes\Focus\Enums\Size;
use Awcodes\Focus\Screenshot;
use Awcodes\Focus\ScreenshotSuite;

/*
 * Documentation screenshots for Gravatar, generated with awcodes/focus from the Workbench (run `composer build`
 * first). The Workbench seeds five fixed users and configures the plugin with the robohash default at 200px.
 */

// Gravatar requests are answered from generated stand-in images in workbench/fixtures/gravatar, the way Gravatar
// itself answers them: an address with a picture of its own gets that picture, and any other address gets the
// image for the requested `d=` default.
$gravatar = function (string $url): string {
    $directory = __DIR__ . '/workbench/fixtures/gravatar';
    $hash = basename((string) parse_url($url, PHP_URL_PATH));
    parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
    $default = is_string($query['d'] ?? null) ? $query['d'] : 'mp';

    foreach (["{$hash}.png", "{$default}-{$hash}.png", "{$default}.png"] as $file) {
        if (is_file("{$directory}/{$file}")) {
            return "{$directory}/{$file}";
        }
    }

    throw new RuntimeException("No Gravatar fixture for [{$url}].");
};

// The awcodes card templates frame each screenshot at 1400x816. The users page is captured in that shape at
// 1225x714, the smallest size that fits the whole table, and the template scales it up. The two-up cards show it
// twice: the light capture large at the back, and the dark one in front of its lower-left part.
$card = [1225, 714];

return ScreenshotSuite::make()
    ->fixture('https://www.gravatar.com/avatar/**', $gravatar)
    ->screenshots([
        // The open user menu, framed with the avatar button above it.
        Screenshot::make('user-menu')
            ->visit('/admin/users')
            ->click('button[aria-label="User menu"]')
            ->focus('[x-ref="panel"]:has([data-focus="user-menu"])')
            ->padding(64),

        Screenshot::make('users-table')
            ->visit('/admin/users')
            ->focus('[data-focus="users-table"]'),

        // The share-image source, shaped to the card templates' screenshot slot and captured in both themes.
        Screenshot::make('card-users')
            ->viewportSize(...$card)
            ->visit('/admin/users')
            ->click('button[aria-label="User menu"]')
            ->viewport(),
    ])
    ->cardTemplates('https://github.com/awcodes/focus-templates/tree/v2.0.0/dist')
    ->cards([
        // Open Graph and the GitHub social preview share one 2400x1260 template; GitHub crops 30px top and bottom.
        Card::make('social')
            ->template('two-up-wide')
            ->title('Gravatar')
            ->screenshots(['card-users', 'card-users'])
            ->sizes([Size::OpenGraph, Size::GitHubSocial]),

        // The Filament plugin directory's 2560x1440 thumbnail.
        Card::make('thumbnail')
            ->template('two-up')
            ->title('Gravatar')
            ->screenshots(['card-users', 'card-users'])
            ->sizes([Size::Filament]),
    ]);
