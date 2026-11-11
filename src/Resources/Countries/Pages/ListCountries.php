<?php

declare(strict_types=1);

namespace Larawell\CountryFilament\Resources\Countries\Pages;

use Filament\Resources\Pages\ListRecords;
use Larawell\CountryFilament\Resources\Countries\CountryResource;

final class ListCountries extends ListRecords
{
    protected static string $resource = CountryResource::class;
}
