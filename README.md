# lara-well/country-filament

Filament 5 administration for [`lara-well/country`](../country). Browse the countries and correct their defaults. Countries are reference data, so there is no create and no delete.

## Installation

```bash
composer require lara-well/country-filament
```

Requires PHP 8.5, Filament 5 and `lara-well/country` (with its migrations run). It also needs `lara-well/currency` and `lara-well/language`, which `lara-well/country` already requires.

## Register the plugin

```php
use Larawell\CountryFilament\CountryFilamentPlugin;

$panel->plugin(CountryFilamentPlugin::make());
```

Options, all optional:

```php
CountryFilamentPlugin::make()
    ->navigationGroup('Settings')
    ->navigationSort(20)
    ->authorize(fn ($user): bool => $user->can('manage-settings'));
```

`authorize()` receives the authenticated user. When it returns `false` the navigation entries are hidden and every page answers 403 (implemented through `canAccess()` of the resources). Laravel policies you register for the models keep working as usual; without a policy the screens are open to every panel user.

## Screens

**Countries**: list with flag and name localized by the app locale (ICU), ISO code, ISO 3 code (hidden by default), currency, locale, language, calling code, week start and EU membership; search by English name, code, ISO 3 code or calling code, filters for EU membership and currency, sort by code, name, currency, language and EU membership. Currency and language are eager-loaded. Editing changes `currency_id`, `language_id`, `calling_code` (format `+421`), `week_start` and `eu_member`.

The localized name cannot be searched or sorted in the database: search and sorting by name use the English `name` column.

## Translations

`resources/lang/{en,sk}/`, namespace `country-filament::`. Publish with `php artisan vendor:publish --tag=country-filament-translations`. Slovak texts address the administrator formally.

## Development

```bash
composer test && composer analyse && composer format
```

Tests run Filament through Livewire on Orchestra Testbench with `Model::shouldBeStrict()` (no lazy loading).

## License

MIT
