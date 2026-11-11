<?php

declare(strict_types=1);

namespace Larawell\CountryFilament;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Larawell\CountryFilament\Resources\Countries\CountryResource;

/**
 * Registers the language administration in a Filament panel.
 */
final class CountryFilamentPlugin implements Plugin
{
    public const string ID = 'lara-well-country';

    private ?string $navigationGroup = null;

    private ?int $navigationSort = null;

    private ?Closure $authorize = null;

    public static function make(): static
    {
        return app(self::class);
    }

    /** The instance registered in the current panel, or a default one outside a panel. */
    public static function current(): self
    {
        $plugin = filament()->hasPlugin(self::ID) ? filament()->getPlugin(self::ID) : null;

        return $plugin instanceof self ? $plugin : new self;
    }

    public function getId(): string
    {
        return self::ID;
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            CountryResource::class,
        ]);
    }

    public function boot(Panel $panel): void {}

    public function navigationGroup(?string $group): static
    {
        $this->navigationGroup = $group;

        return $this;
    }

    public function navigationSort(?int $sort): static
    {
        $this->navigationSort = $sort;

        return $this;
    }

    /**
     * Restrict the screens. The callback receives the authenticated user; returning false
     * hides the navigation and answers 403. Without a callback everyone allowed by the
     * panel and the registered policies has access.
     *
     * @param  Closure(mixed): bool  $callback
     */
    public function authorize(Closure $callback): static
    {
        $this->authorize = $callback;

        return $this;
    }

    public function getNavigationGroup(): ?string
    {
        return $this->navigationGroup;
    }

    public function getNavigationSort(): ?int
    {
        return $this->navigationSort;
    }

    public function isAuthorized(): bool
    {
        return $this->authorize === null || ($this->authorize)(filament()->auth()->user()) !== false;
    }
}
