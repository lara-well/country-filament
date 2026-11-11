<?php

declare(strict_types=1);

return [
    'label' => 'Krajina',
    'plural_label' => 'Krajiny',
    'empty' => 'Nenašli sa žiadne krajiny',
    'sections' => [
        'country' => 'Krajina',
        'defaults' => 'Predvolené hodnoty',
        'defaults_description' => 'Použijú sa ako východiskové hodnoty pre používateľov z tejto krajiny.',
    ],
    'fields' => [
        'id' => 'Kód',
        'iso3' => 'Kód ISO 3',
        'name' => 'Krajina',
        'locale' => 'Miestne nastavenie',
        'currency_id' => 'Mena',
        'language_id' => 'Jazyk',
        'calling_code' => 'Predvoľba',
        'week_start' => 'Týždeň začína v',
        'eu_member' => 'Člen EÚ',
    ],
    'help' => [
        'calling_code' => 'Medzinárodná predvoľba so znamienkom plus, napríklad +421.',
        'eu_member' => 'Zapnite pri členských štátoch Európskej únie.',
    ],
    'week_start' => [
        'monday' => 'pondelok',
        'tuesday' => 'utorok',
        'wednesday' => 'streda',
        'thursday' => 'štvrtok',
        'friday' => 'piatok',
        'saturday' => 'sobota',
        'sunday' => 'nedeľa',
    ],
];
