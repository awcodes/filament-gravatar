<?php

namespace Awcodes\FilamentGravatar;

use Exception;
use Filament\Contracts\Plugin;
use Filament\Panel;

class GravatarPlugin implements Plugin
{
    protected ?int $size = null;

    protected ?string $default = null;

    protected ?string $rating = null;

    public function getId(): string
    {
        return 'awcodes/gravatar';
    }

    public function register(Panel $panel): void
    {
    }

    public function boot(Panel $panel): void
    {
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }

    public function size(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function default(string $default): static
    {
        if (! in_array($default, ['404', 'mp', 'identicon', 'monsterid', 'wavatar', 'robohash'])) {
            throw new Exception('Invalid default');
        }

        $this->default = $default;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function rating(string $rating): static
    {
        if (! in_array($rating, ['g', 'pg', 'r', 'x'])) {
            throw new Exception('Invalid rating');
        }

        $this->rating = $rating;

        return $this;
    }

    public function getSize(): int
    {
        return $this->size ?? 80;
    }

    public function getDefault(): string
    {
        return $this->default ?? 'mp';
    }

    public function getRating(): string
    {
        return $this->rating ?? 'g';
    }
}
