<?php

declare(strict_types=1);

namespace Larawell\CountryFilament\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use Larawell\CountryFilament\CountryFilamentPlugin;

final class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->plugin(CountryFilamentPlugin::make());
    }
}
