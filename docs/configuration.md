---
title: Configuration
description: Set the panel-wide avatar size, fallback image, and content rating on the Gravatar plugin.
---

# Configuration

Panel-wide defaults are set with chained methods on `GravatarPlugin`.

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
        ]);
}
```

All three are optional. Anything you leave out uses the value in the table below.

| Method | Default | Accepts |
| --- | --- | --- |
| `size()` | `80` | An integer from 1 to 2048 |
| `default()` | `mp` | A value from the `Defaults` enum |
| `rating()` | `g` | A value from the `Rating` enum |

## Size

Pixel dimensions of the avatar. Gravatar images are square, so this sets both edges.

```php
GravatarPlugin::make()->size(200)
```

Values outside 1–2048 throw an exception at panel registration, so a bad size surfaces immediately on boot rather than as a broken image later.

## Default image

The image served when an email address has no Gravatar associated with it.

```php
use Awcodes\Gravatar\Enums\Defaults;

GravatarPlugin::make()->default(Defaults::Robohash)
```

Accepted values are the cases of `Awcodes\Gravatar\Enums\Defaults`:

| Value | Result |
| --- | --- |
| `initials` | The user's initials |
| `color` | A flat generated color |
| `mp` | Gravatar's "mystery person" silhouette |
| `identicon` | A geometric pattern derived from the hash |
| `monsterid` | A generated monster face |
| `wavatar` | A generated face |
| `robohash` | A generated robot |
| `404` | No image — Gravatar returns a 404 instead |

Passing a string works too, and is checked against the same enum:

```php
GravatarPlugin::make()->default('robohash')
```

`mp` is the value used when you do not call `default()` at all, so setting it explicitly is equivalent to omitting the call.

Choosing `404` is useful when you want to detect the absence of a Gravatar in your own code rather than show a generated image.

## Rating

The maximum content rating you are willing to display. Gravatar serves the default image instead of any avatar rated above this.

```php
use Awcodes\Gravatar\Enums\Rating;

GravatarPlugin::make()->rating(Rating::PG)
```

Accepted values are the cases of `Awcodes\Gravatar\Enums\Rating`:

| Value | Meaning |
| --- | --- |
| `g` | Suitable for all audiences |
| `pg` | May contain rude gestures, provocative clothing, mild violence |
| `r` | May contain harsh profanity, intense violence, nudity, drug use |
| `x` | May contain hardcore sexual imagery or extreme violence |

Ratings are inclusive and cumulative — `pg` permits both `g` and `pg` avatars.

An unrecognized rating throws `Invalid Gravatar rating`.

## Using the enums

Both enums are backed by strings, so the enum case and its string value are interchangeable. Prefer the enum where you want your editor to autocomplete the options and catch typos before runtime:

```php
use Awcodes\Gravatar\Enums\Defaults;
use Awcodes\Gravatar\Enums\Rating;

GravatarPlugin::make()
    ->default(Defaults::Identicon)
    ->rating(Rating::G);
```
