<?php

declare(strict_types=1);

use Filament\Forms\Components\Field;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Larawell\CountryFilament\Tests\TestCase;

uses(TestCase::class)->in('Feature');

/**
 * Names of editable fields in the schema that have no non-empty helper text.
 *
 * @return list<string>
 */
function fieldsWithoutHelperText(Schema $schema): array
{
    $missing = [];

    foreach ($schema->getFlatFields(withHidden: true) as $field) {
        $texts = collect($field->getChildSchema(Field::BELOW_CONTENT_SCHEMA_KEY)?->getComponents() ?? [])
            ->filter(fn ($component): bool => $component instanceof Text && filled($component->getContent()));

        if ($texts->isEmpty()) {
            $missing[] = $field->getName();
        }
    }

    return $missing;
}
