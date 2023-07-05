# Filament Gravatar

Replace Filament's default avatar url provider with one for Gravatar.

## Installation

First, install the plugin with composer.

```bash
composer require awcodes/filament-gravatar
```

Next, add the `GravatarProvider` to your panel.

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->defaultAvatarProvider(GravatarProvider::class)
}
```

## Global Defaults

You can modify the global defaults, should you need to by publishing the config file.

```bash
php artisan vendor:publish --tag="filament-gravatar-config"
```

```php
return [
    'size' => 80, // 1 - 2048
    'default' => 'mp', // 404 | mp | identicon | monsterid | wavatar | robohash
    'rating' => 'g', // g | pg | r | x
];
```

## Additional Info

You can also use the `FilamentGravatar\Gravatar` class by itself should you need to outside of Filament.

```php
FilamentGravatar\Gravatar::get(
    string $email = null,
    int $size = 80,
    string $default = 'mp',
    string $rating = 'g',
    bool $asImage = false,
    array $attributes = []
);
```