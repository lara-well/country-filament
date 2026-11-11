<?php

declare(strict_types=1);

namespace Larawell\CountryFilament\Resources\Countries\Pages;

use Filament\Resources\Pages\EditRecord;
use Larawell\CountryFilament\Resources\Countries\CountryResource;

final class EditCountry extends EditRecord
{
    protected static string $resource = CountryResource::class;
}
