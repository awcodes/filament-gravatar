---
title: Usage
description: Build Gravatar URLs and image tags outside a Filament panel with the Gravatar class.
---

# Usage

Inside a panel, avatars are handled for you once the provider is registered. The `Awcodes\Gravatar\Gravatar` class is available for everywhere else — a Blade view, a mail template, an API response, or any Laravel application not using Filament at all.

## Building a URL

```php
use Awcodes\Gravatar\Gravatar;

$url = Gravatar::get('person@example.com');
```

That returns a Gravatar URL for the address, using the method's own defaults — 80 pixels, the `mp` fallback image, and a `g` rating.

## Parameters

```php
Gravatar::get(
    email: 'person@example.com',
    size: 200,
    default: 'robohash',
    rating: 'pg',
    asImage: false,
    attributes: [],
);
```

| Parameter | Type | Default | Purpose |
| --- | --- | --- | --- |
| `email` | `?string` | `null` | Address to look up |
| `size` | `int` | `80` | Pixel dimensions, 1–2048 |
| `default` | `string` | `mp` | Fallback image when no Gravatar exists |
| `rating` | `string` | `g` | Maximum content rating |
| `asImage` | `bool` | `false` | Return a full image tag instead of a URL |
| `attributes` | `array` | `[]` | Extra attributes for the image tag |

> [!NOTE]
> `Gravatar::get()` takes its arguments directly and does not read the panel's plugin settings. Values configured on `GravatarPlugin` apply to panel avatars only — pass them again here if you want to match.

Unlike the plugin methods, these arguments are not validated against the enums. An unrecognized `default` or `rating` is passed through to Gravatar as-is.

## Returning an image tag

Set `asImage` to `true` to get a complete image element rather than a bare URL:

```php
$img = Gravatar::get(
    email: 'person@example.com',
    size: 200,
    asImage: true,
    attributes: ['class' => 'rounded-full', 'alt' => 'Avatar'],
);
```

Every key and value in `attributes` is rendered onto the tag:

```html
<img src="https://www.gravatar.com/avatar/..." class="rounded-full" alt="Avatar" />
```

Because the return value is markup rather than text, echo it unescaped in Blade:

```blade
{!! Gravatar::get(email: $user->email, asImage: true) !!}
```

> [!WARNING]
> Attribute values are inserted without escaping. Build the attribute array from values you control, not from user input.

## Handling a missing address

Passing `null`, an empty string, or `'0'` omits the hash from the URL entirely, so Gravatar has nothing to match and serves the default image.

```php
Gravatar::get(null, default: 'identicon');
```

This means an anonymous or incomplete record still produces a usable avatar rather than a broken image, which is why the panel provider can safely call it for records without an email.
