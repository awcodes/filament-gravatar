---
title: Installation
description: Install the package and register the Gravatar avatar provider on a Filament panel.
---

# Installation

## Compatibility

| Filament version | Package version |
|------------------|-----------------|
| 2.x              | 1.x             |
| 3.x              | 2.x             |
| 4.x              | 3.x             |
| 4.x & 5.x        | 4.x             |

Gravatar requires PHP 8.2 or later and `filament/filament`.

## Install the package

Install with Composer:

```bash
composer require awcodes/filament-gravatar
```

## Register with your panel

Two things need to be added to your panel provider: the avatar provider, and the plugin.

```php
use Awcodes\Gravatar\GravatarProvider;
use Awcodes\Gravatar\GravatarPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->defaultAvatarProvider(GravatarProvider::class)
        ->plugins([
            GravatarPlugin::make(),
        ]);
}
```

> [!IMPORTANT]
> Both lines are required. `defaultAvatarProvider()` tells Filament to use Gravatar, while the plugin is what holds the size, default, and rating settings that the provider reads. Registering the provider without the plugin will fail at runtime when the provider looks the plugin up.

Once registered, every avatar in the panel is served from Gravatar using the panel's settings.

## Which email is used

The provider reads the `email` attribute from the authenticated record. If that attribute is missing or is not a string, the avatar falls back to the generated default image rather than erroring.

Continue to [Configuration](configuration.md) to change the size, fallback image, or rating.
