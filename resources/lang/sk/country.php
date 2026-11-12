<?php

declare(strict_types=1);

return [
    'label' => 'Krajina',
    'plural_label' => 'Krajiny',
    'empty' => 'Nenašli sa žiadne krajiny',
    'sections' => [
        'country' => 'Krajina',
        'country_description' => 'Referenčné údaje z normy ISO 3166. Tieto hodnoty sa tu nedajú zmeniť.',
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
        'currency_id' => 'Mena, ktorá sa predvolene použije pre používateľov z tejto krajiny. Nechajte prázdne, ak nemá byť žiadna.',
        'language_id' => 'Hlavný jazyk, ktorý sa predvolene použije pre používateľov z tejto krajiny. Nechajte prázdne, ak nemá byť žiadny.',
        'week_start' => 'Prvý deň týždňa v kalendároch pre používateľov z tejto krajiny.',
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
