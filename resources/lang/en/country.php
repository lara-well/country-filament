<?php

declare(strict_types=1);

return [
    'label' => 'Country',
    'plural_label' => 'Countries',
    'empty' => 'No countries found',
    'sections' => [
        'country' => 'Country',
        'defaults' => 'Defaults',
        'defaults_description' => 'Used as the starting values for users from this country.',
    ],
    'fields' => [
        'id' => 'Code',
        'iso3' => 'ISO 3 code',
        'name' => 'Country',
        'locale' => 'Locale',
        'currency_id' => 'Currency',
        'language_id' => 'Language',
        'calling_code' => 'Calling code',
        'week_start' => 'Week starts on',
        'eu_member' => 'EU member',
    ],
    'help' => [
        'calling_code' => 'International prefix with a plus sign, for example +421.',
        'eu_member' => 'Switch on for member states of the European Union.',
    ],
    'week_start' => [
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday',
    ],
];
