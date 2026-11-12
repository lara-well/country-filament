# AGENTS.md: lara-well/country-filament

- Namespace `Larawell\CountryFilament\`, PHP ^8.5, Filament ^5.0, Pest + Orchestra Testbench (SQLite in memory). The data model belongs to `lara-well/country`: this package has no migrations and no models of its own.
- Filament 5 namespaces: `Filament\Schemas\Schema`, `Filament\Schemas\Components\Section`, `Filament\Forms\Components\*`, `Filament\Actions\*`, table `recordActions()` / `toolbarActions()`. Read `vendor/filament/` when unsure; do not guess.
- Access control: the plugin's `authorize()` callback is applied in each resource's `canAccess()` and `shouldRegisterNavigation()`. Keep that for every new resource or page.
- Every action that changes data (record, bulk, header, relation-manager actions, reordering) must be authorized like the matching page: the resource's `canEdit()` / `canDelete()` (model policy, plugin callback) and `authorizeIndividualRecords(fn ...)` for bulk actions. Do not use the string form `authorize('update')`: it denies when no policy is registered. Read-only resources expose no mutating action. Each package has a test with a policy that denies `update`.
- No hardcoded text: labels, help texts, actions and notifications go through `country-filament::` translation keys (English keys, `en` + `sk`, Slovak formal address).
- Tables eager-load what a row shows, are paginated, and searchable/sortable columns must be real database columns. Destructive actions need confirmation.
- Tests use `Model::shouldBeStrict()`. Before finishing run `composer test`, `composer analyse`, `composer format`.
- UI rule 1: every editable field (forms, relation managers, action modals, custom pages) has `->helperText(__('country-filament::...'))` in `en` and `sk`; a section with only read-only entries has a `->description()` naming the source. A help text says what the value does, never just repeats the label.
- UI rule 2: a section is full width (`->columnSpanFull()`) with 2 or 3 columns, or two sections sit side by side (half width) with 1 or 2 columns; never 3+ columns in a half-width section. Modal forms use 1 or 2 columns; long texts span the full width.
- UI rule 3: list pages of records with an on/off state use `getTabs()` (`Filament\Schemas\Components\Tabs\Tab`) with a `badge()` count and translated labels (`tabs.*`). Countries have no on/off flag, so no tabs.
