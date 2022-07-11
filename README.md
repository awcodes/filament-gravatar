# Filament Gravatar

Replace Filament's default avatar url provider with one for Gravatar.

## Installation

First, install the plugin with composer.

```bash
composer require awcodes/filament-gravatar
```

Next, update your Filament config file to use the new avatar provider.
```php
'default_avatar_provider' => \FilamentGravatar\UiAvatarsProvider::class,
```

## Global Defaults

You can modify the global defaults, should you need to by publishing the config file.

```bash
php artisan vendor:publish --tag="filament-gravatar-config"
```

## Additional Info

You can also use the `FilamentGravatar\Gravatar` class by itself should you need to outside of Filament.

```php
FilamentGravatar\Gravatar::get(
    string $email = null,
    int $s = 80,
    string $d = 'mp',
    string $r = 'g',
    bool $img = false,
    $atts = []
);
```