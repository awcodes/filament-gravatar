![gravatar-og](https://res.cloudinary.com/aw-codes/image/upload/w_1200,f_auto,q_auto/plugins/gravatar/awcodes-gravatar.jpg)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/awcodes/filament-gravatar.svg?style=flat-square)](https://packagist.org/packages/awcodes/filament-gravatar)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/filament-badgeable-column.svg?style=flat-square)](https://packagist.org/packages/awcodes/filament-gravatar)

# Filament Gravatar

Replace Filament's default avatar url provider with one for Gravatar.

## Compatibility

| Package Version | Filament Version |
|-----------------|------------------|
| 1.x             | 2.x              |
| 2.x             | 3.x              |
| 3.x             | 4.x              |
| 4.x             | 5.x              |

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

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [awcodes](https://github.com/awcodes)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
