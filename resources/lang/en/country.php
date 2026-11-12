<?php

declare(strict_types=1);

return [
    'label' => 'Country',
    'plural_label' => 'Countries',
    'empty' => 'No countries found',
    'sections' => [
        'country' => 'Country',
        'country_description' => 'Reference data from ISO 3166. These values cannot be changed here.',
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
        'currency_id' => 'The currency used as the default for users from this country. Leave empty for none.',
        'language_id' => 'The main language used as the default for users from this country. Leave empty for none.',
        'week_start' => 'The first day of the week in calendars for users from this country.',
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
