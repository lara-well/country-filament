<?php

declare(strict_types=1);

use Larawell\CountryFilament\Providers\CountryFilamentServiceProvider;

it('registers its service provider for Laravel package discovery', function (): void {
    /** @var array{extra: array{laravel: array{providers: list<string>}}} $composer */
    $composer = json_decode((string) file_get_contents(__DIR__.'/../../composer.json'), true, flags: JSON_THROW_ON_ERROR);

    // Without it an application loads neither the translations nor the views of the package.
    expect($composer['extra']['laravel']['providers'])->toContain(CountryFilamentServiceProvider::class);
});
