<?php

declare(strict_types=1);

namespace Larawell\CountryFilament\Resources\Countries\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Larawell\Country\Models\Country;
use Larawell\Currency\Models\Currency;

final class CountriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id')
            ->columns([
                TextColumn::make('name')
                    ->label(__('country-filament::country.fields.name'))
                    ->formatStateUsing(static fn (Country $record): string => $record->flag().' '.$record->localizedName(app()->getLocale()))
                    ->searchable(['name', 'id'])
                    ->sortable(),
                TextColumn::make('id')
                    ->label(__('country-filament::country.fields.id'))
                    ->badge()
                    ->color('gray')
                    ->sortable(),
                TextColumn::make('iso3')
                    ->label(__('country-filament::country.fields.iso3'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('currency_id')
                    ->label(__('country-filament::country.fields.currency_id'))
                    ->description(static fn (Country $record): ?string => $record->currency?->name)
                    ->placeholder('—')
                    ->sortable(),
                TextColumn::make('locale')
                    ->label(__('country-filament::country.fields.locale'))
                    ->placeholder('—'),
                TextColumn::make('language_id')
                    ->label(__('country-filament::country.fields.language_id'))
                    ->description(static fn (Country $record): ?string => $record->language?->native_name)
                    ->placeholder('—')
                    ->sortable(),
                TextColumn::make('calling_code')
                    ->label(__('country-filament::country.fields.calling_code'))
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('week_start')
                    ->label(__('country-filament::country.fields.week_start'))
                    ->formatStateUsing(static fn (Country $record): string => __('country-filament::country.week_start.'.$record->week_start->value)),
                IconColumn::make('eu_member')
                    ->label(__('country-filament::country.fields.eu_member'))
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('eu_member')->label(__('country-filament::country.fields.eu_member')),
                SelectFilter::make('currency_id')
                    ->label(__('country-filament::country.fields.currency_id'))
                    ->options(static fn (): array => Currency::query()
                        ->whereIn('id', Country::query()->whereNotNull('currency_id')->select('currency_id'))
                        ->orderBy('id')
                        ->pluck('id', 'id')
                        ->all())
                    ->searchable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->emptyStateHeading(__('country-filament::country.empty'))
            ->paginated([25, 50, 100]);
    }
}
