<?php

declare(strict_types=1);

namespace Larawell\CountryFilament\Resources\Countries;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Larawell\Country\Models\Country;
use Larawell\CountryFilament\CountryFilamentPlugin;
use Larawell\CountryFilament\Resources\Countries\Pages\EditCountry;
use Larawell\CountryFilament\Resources\Countries\Pages\ListCountries;
use Larawell\CountryFilament\Resources\Countries\Schemas\CountryForm;
use Larawell\CountryFilament\Resources\Countries\Tables\CountriesTable;

/**
 * Reference data: the defaults of a country can be corrected, countries are never created or deleted.
 */
final class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeEuropeAfrica;

    protected static ?string $slug = 'countries';

    protected static ?int $navigationSort = 40;

    public static function canAccess(): bool
    {
        return CountryFilamentPlugin::current()->isAuthorized() && parent::canAccess();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return CountryFilamentPlugin::current()->isAuthorized() && parent::shouldRegisterNavigation();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getNavigationGroup(): ?string
    {
        return CountryFilamentPlugin::current()->getNavigationGroup();
    }

    public static function getNavigationSort(): ?int
    {
        return CountryFilamentPlugin::current()->getNavigationSort() ?? self::$navigationSort;
    }

    public static function getModelLabel(): string
    {
        return (string) __('country-filament::country.label');
    }

    public static function getPluralModelLabel(): string
    {
        return (string) __('country-filament::country.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return (string) __('country-filament::country.plural_label');
    }

    public static function form(Schema $schema): Schema
    {
        return CountryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CountriesTable::configure($table);
    }

    /**
     * The table shows the currency and the language of every country.
     *
     * @return Builder<Country>
     */
    public static function getEloquentQuery(): Builder
    {
        /** @var Builder<Country> $query */
        $query = parent::getEloquentQuery();

        return $query->with(['currency', 'language']);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCountries::route('/'),
            'edit' => EditCountry::route('/{record}/edit'),
        ];
    }
}
