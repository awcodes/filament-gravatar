# Filament Gravatar

Replace Filament's default avatar url provider with one for Gravatar.

![gravatar-og](https://res.cloudinary.com/aw-codes/image/upload/w_1200,f_auto,q_auto/plugins/gravatar/awcodes-gravatar.jpg)

## Installation

First, install the plugin with composer.

```bash
composer require awcodes/filament-gravatar
```

Next, add the `GravatarProvider` to your panel.

```php
use Awcodes\FilamentGravatar\GravatarProvider;

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

You can also use the `Awcodes\FilamentGravatar\Gravatar` class by itself should you need to outside a panel.

```php
Awcodes\FilamentGravatar\Gravatar::get(
    string $email = null,
    int $size = 80,
    string $default = 'mp',
    string $rating = 'g',
    bool $asImage = false,
    array $attributes = []
);
```
