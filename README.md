# Filament Gravatar

Replace Filament's default avatar url provider with one for Gravatar.

[![Latest Version](https://img.shields.io/github/release/awcodes/filament-gravatar.svg?style=flat-square&color=blue&label=Release)](https://github.com/awcodes/filament-gravatar/releases)
[![MIT Licensed](https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/filament-gravatar.svg?style=flat-square&color=blue&label=Downloads)](https://packagist.org/packages/awcodes/filament-gravatar)
[![GitHub Repo stars](https://img.shields.io/github/stars/awcodes/filament-gravatar?style=flat-square&color=blue&label=Stars)](https://github.com/awcodes/filament-gravatar/stargazers)

## Compatibility

| Package Version | Filament Version |
|-----------------|------------------|
| 1.x             | 2.x              |
| 2.x             | 3.x              |
| 3.x             | 4.x              |
| 4.x             | 5.x              |

<!-- [docs_start] -->

## Installation

First, install the plugin with composer.

```bash
composer require awcodes/filament-gravatar
```

Next, add the `GravatarProvider` to your panel.

```php
use Awcodes\Gravatar\GravatarProvider;
use Awcodes\Gravatar\GravatarPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->defaultAvatarProvider(GravatarProvider::class)
        ->plugins([
            GravatarPlugin::make(),
        ])
}
```

## Global Defaults

You can modify the global defaults by using the following methods on the `GravatarPlugin`.

```php
use Awcodes\Gravatar\GravatarPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GravatarPlugin::make()
                ->default('robohash')
                ->size(200)
                ->rating('pg'),
        ])
}
```

## Additional Info

You can also use the `Awcodes\Gravatar\Gravatar` class by itself should you need to outside a panel.

```php
Awcodes\Gravatar\Gravatar::get(
    string $email = null,
    int $size = 80,
    string $default = 'mp',
    string $rating = 'g',
    bool $asImage = false,
    array $attributes = []
);
```

<!-- [docs_end] -->

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [awcodes](https://github.com/awcodes)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
