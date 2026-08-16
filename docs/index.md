---
title: Filament Gravatar
description: Replace a Filament panel's default avatar provider with one backed by Gravatar.
---

# Filament Gravatar

Filament Gravatar swaps a panel's default avatar provider for one that serves avatars from [Gravatar](https://gravatar.com), based on each user's email address.

Filament's built-in provider generates avatars from a user's initials. This package instead looks up the address in Gravatar, so users who already have a Gravatar profile see their own picture, and everyone else falls back to a generated image of your choosing.

## How it works

The provider reads the `email` attribute from the authenticated record, hashes it, and builds a Gravatar URL from it. No API calls are made from your application — the avatar is an image URL that the browser requests directly.

Because the lookup is entirely derived from the email address, there is nothing to store, sync, or invalidate.

## What you can control

Three settings apply to every avatar in the panel:

- **Size** — the pixel dimensions of the image.
- **Default** — the generated image style used when an address has no Gravatar.
- **Rating** — the maximum content rating you are willing to display.

See [Configuration](configuration.md) for the accepted values.

## Outside a panel

The underlying `Gravatar` class can be used on its own, anywhere in a Laravel application, to build a Gravatar URL or a complete image tag. See [Usage](usage.md).

## Next steps

Start with [Installation](installation.md).
