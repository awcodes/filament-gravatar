---
title: Installation
description: Install the package and register the Gravatar avatar provider on a Filament panel.
---

# Installation

## Requirements

- PHP 8.2 or higher
- Filament 4.x or 5.x

Earlier releases of this package support earlier versions of Filament:

| Package Version | Filament Version |
| --- | --- |
| 1.x | 2.x |
| 2.x | 3.x |
| 3.x | 4.x |
| 4.x | 4.x & 5.x |

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
