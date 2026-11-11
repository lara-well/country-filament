<?php

declare(strict_types=1);

namespace Larawell\CountryFilament\Resources\Countries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Larawell\Country\Enums\WeekStart;
use Larawell\Country\Models\Country;
use Larawell\Currency\Models\Currency;
use Larawell\Language\Models\Language;

final class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(__('country-filament::country.sections.country'))
                ->columns(2)
                ->schema([
                    TextEntry::make('id')->label(__('country-filament::country.fields.id')),
                    TextEntry::make('iso3')->label(__('country-filament::country.fields.iso3')),
                    TextEntry::make('name')
                        ->label(__('country-filament::country.fields.name'))
                        ->formatStateUsing(static fn (Country $record): string => $record->flag().' '.$record->localizedName(app()->getLocale())),
                    TextEntry::make('locale')
                        ->label(__('country-filament::country.fields.locale'))
                        ->placeholder('—'),
                ]),
            Section::make(__('country-filament::country.sections.defaults'))
                ->description(__('country-filament::country.sections.defaults_description'))
                ->columns(2)
                ->schema([
                    Select::make('currency_id')
                        ->label(__('country-filament::country.fields.currency_id'))
                        ->options(static fn (): array => Currency::query()->orderBy('id')->get(['id', 'name'])
                            ->mapWithKeys(static fn (Currency $currency): array => [$currency->id => $currency->id.' – '.$currency->name])->all())
                        ->searchable(),
                    Select::make('language_id')
                        ->label(__('country-filament::country.fields.language_id'))
                        ->options(static fn (): array => Language::query()->orderBy('name')->get(['id', 'name', 'native_name'])
                            ->mapWithKeys(static fn (Language $language): array => [$language->id => $language->id.' – '.$language->native_name])->all())
                        ->searchable(),
                    TextInput::make('calling_code')
                        ->label(__('country-filament::country.fields.calling_code'))
                        ->helperText(__('country-filament::country.help.calling_code'))
                        ->placeholder('+421')
                        ->regex('/^\+[1-9]\d{0,6}$/')
                        ->maxLength(8),
                    Select::make('week_start')
                        ->label(__('country-filament::country.fields.week_start'))
                        ->options(self::weekStarts())
                        ->required(),
                    Toggle::make('eu_member')
                        ->label(__('country-filament::country.fields.eu_member'))
                        ->helperText(__('country-filament::country.help.eu_member'))
                        ->inline(false),
                ]),
        ]);
    }

    /**
     * @return array<string, string>
     */
    public static function weekStarts(): array
    {
        return collect(WeekStart::cases())
            ->mapWithKeys(static fn (WeekStart $day): array => [$day->value => __('country-filament::country.week_start.'.$day->value)])
            ->all();
    }
}
