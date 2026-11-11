<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Larawell\Country\Enums\WeekStart;
use Larawell\Country\Models\Country;
use Larawell\CountryFilament\CountryFilamentPlugin;
use Larawell\CountryFilament\Resources\Countries\CountryResource;
use Larawell\CountryFilament\Resources\Countries\Pages\EditCountry;
use Larawell\CountryFilament\Resources\Countries\Pages\ListCountries;
use Livewire\Livewire;

beforeEach(function (): void {
    $this->signIn();
});

it('lists countries with flag and localized name', function (): void {
    $slovakia = Country::query()->findOrFail('SK');
    $czechia = Country::query()->findOrFail('CZ');

    app()->setLocale('sk');

    Livewire::test(ListCountries::class)
        ->assertOk()
        ->searchTable('SVK')
        ->assertCanSeeTableRecords([$slovakia])
        ->assertCanNotSeeTableRecords([$czechia])
        ->assertSee('🇸🇰 Slovensko')
        ->assertSee('+421');
});

it('searches by name and calling code', function (): void {
    Livewire::test(ListCountries::class)
        ->searchTable('Czech')
        ->assertCanSeeTableRecords([Country::query()->findOrFail('CZ')])
        ->assertCanNotSeeTableRecords([Country::query()->findOrFail('SK')])
        ->searchTable('+421')
        ->assertCanSeeTableRecords([Country::query()->findOrFail('SK')]);
});

it('filters by EU membership and currency', function (): void {
    $slovakia = Country::query()->findOrFail('SK');
    $us = Country::query()->findOrFail('US');
    $czechia = Country::query()->findOrFail('CZ');

    Livewire::test(ListCountries::class)
        ->set('tableRecordsPerPage', 50)
        ->filterTable('eu_member', true)
        ->assertCanSeeTableRecords([$slovakia, $czechia])
        ->assertCanNotSeeTableRecords([$us])
        ->filterTable('eu_member', false)
        ->sortTable('id', 'desc')
        ->assertCanSeeTableRecords([$us])
        ->assertCanNotSeeTableRecords([$slovakia, $czechia])
        ->resetTableFilters()
        ->filterTable('currency_id', 'EUR')
        ->set('tableRecordsPerPage', 50)
        ->assertCanSeeTableRecords([$slovakia])
        ->assertCanNotSeeTableRecords([$czechia, $us]);
});

it('eager loads the currency and language of the rows', function (): void {
    DB::enableQueryLog();

    Livewire::test(ListCountries::class)->assertOk();

    expect(collect(DB::getQueryLog())->filter(fn (array $q): bool => str_contains($q['query'], 'from "currencies"') || str_contains($q['query'], 'from "languages"'))->count())->toBeLessThan(6);
});

it('edits the defaults of a country', function (): void {
    Livewire::test(EditCountry::class, ['record' => 'CZ'])
        ->assertOk()
        ->fillForm([
            'currency_id' => 'EUR',
            'language_id' => 'sk-SK',
            'calling_code' => '+420',
            'week_start' => 'sunday',
            'eu_member' => false,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $czechia = Country::query()->findOrFail('CZ');

    expect($czechia->currency_id)->toBe('EUR')
        ->and($czechia->language_id)->toBe('sk-SK')
        ->and($czechia->week_start)->toBe(WeekStart::Sunday)
        ->and($czechia->eu_member)->toBeFalse()
        ->and($czechia->name)->not->toBeEmpty();
});

it('validates the edit form', function (): void {
    Livewire::test(EditCountry::class, ['record' => 'CZ'])
        ->fillForm(['calling_code' => '420', 'week_start' => null, 'currency_id' => 'ZZZ'])
        ->call('save')
        ->assertHasFormErrors(['calling_code' => 'regex', 'week_start' => 'required', 'currency_id']);

    Livewire::test(EditCountry::class, ['record' => 'CZ'])
        ->fillForm(['calling_code' => '+420123456789'])
        ->call('save')
        ->assertHasFormErrors(['calling_code']);
});

it('has no create or delete', function (): void {
    expect(CountryResource::canCreate())->toBeFalse()
        ->and(CountryResource::canDeleteAny())->toBeFalse()
        ->and(CountryResource::hasPage('create'))->toBeFalse();

    Livewire::test(EditCountry::class, ['record' => 'CZ'])->assertActionDoesNotExist('delete');
});

it('is hidden and forbidden when the plugin callback denies access', function (): void {
    expect(CountryResource::shouldRegisterNavigation())->toBeTrue();

    CountryFilamentPlugin::current()->authorize(fn ($user): bool => false);

    expect(CountryResource::canAccess())->toBeFalse()
        ->and(CountryResource::shouldRegisterNavigation())->toBeFalse();

    Livewire::test(ListCountries::class)->assertForbidden();
    $this->get('/admin/countries')->assertForbidden();
});

it('applies navigation options and ships translations', function (): void {
    CountryFilamentPlugin::current()->navigationGroup('Settings')->navigationSort(4);

    expect(CountryResource::getNavigationGroup())->toBe('Settings')
        ->and(CountryResource::getNavigationSort())->toBe(4)
        ->and(__('country-filament::country.plural_label', [], 'sk'))->toBe('Krajiny');
});
