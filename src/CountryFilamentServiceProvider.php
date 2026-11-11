<?php

declare(strict_types=1);

namespace Larawell\CountryFilament;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class CountryFilamentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('country-filament')
            ->hasTranslations();
    }
}
