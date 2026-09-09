<?php

declare(strict_types=1);

namespace Awcodes\Gravatar;

use Awcodes\Gravatar\Enums\Defaults;
use Awcodes\Gravatar\Enums\Rating;
use Exception;
use Filament\Contracts\Plugin;
use Filament\Panel;

class GravatarPlugin implements Plugin
{
    protected ?int $size = null;

    protected ?string $default = null;

    protected ?string $rating = null;

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function getId(): string
    {
        return 'awcodes/gravatar';
    }

    public function register(Panel $panel): void {}

    public function boot(Panel $panel): void {}

    /** @throws Exception */
    public function size(int $size): static
    {
        if ($size < Gravatar::MIN_SIZE || $size > Gravatar::MAX_SIZE) {
            throw new Exception(
                sprintf('Gravatar Size must be between %d and %d pixels', Gravatar::MIN_SIZE, Gravatar::MAX_SIZE)
            );
        }

        $this->size = $size;

        return $this;
    }

    /** @throws Exception */
    public function default(string | Defaults $default): static
    {
        if (is_string($default)) {
            $default = Defaults::tryFrom($default) ?? null;
        }

        if (! $default) {
            throw new Exception('Invalid Gravatar default');
        }

        $this->default = $default->value;

        return $this;
    }

    /** @throws Exception */
    public function rating(string | Rating $rating): static
    {
        if (is_string($rating)) {
            $rating = Rating::tryFrom($rating) ?? null;
        }

        if (! $rating) {
            throw new Exception('Invalid Gravatar rating');
        }

        $this->rating = $rating->value;

        return $this;
    }

    public function getSize(): int
    {
        return $this->size ?? Gravatar::DEFAULT_SIZE;
    }

    public function getDefault(): string
    {
        return $this->default ?? Defaults::Mp->value;
    }

    public function getRating(): string
    {
        return $this->rating ?? Rating::G->value;
    }
}
