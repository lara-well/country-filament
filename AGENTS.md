# AGENTS.md: lara-well/country-filament

- Namespace `Larawell\CountryFilament\`, PHP ^8.5, Filament ^5.0, Pest + Orchestra Testbench (SQLite in memory). The data model belongs to `lara-well/country`: this package has no migrations and no models of its own.
- Filament 5 namespaces: `Filament\Schemas\Schema`, `Filament\Schemas\Components\Section`, `Filament\Forms\Components\*`, `Filament\Actions\*`, table `recordActions()` / `toolbarActions()`. Read `vendor/filament/` when unsure; do not guess.
- Access control: the plugin's `authorize()` callback is applied in each resource's `canAccess()` and `shouldRegisterNavigation()`. Keep that for every new resource or page.
- Every action that changes data (record, bulk, header, relation-manager actions, reordering) must be authorized like the matching page: the resource's `canEdit()` / `canDelete()` (model policy, plugin callback) and `authorizeIndividualRecords(fn ...)` for bulk actions. Do not use the string form `authorize('update')`: it denies when no policy is registered. Read-only resources expose no mutating action. Each package has a test with a policy that denies `update`.
- No hardcoded text: labels, help texts, actions and notifications go through `country-filament::` translation keys (English keys, `en` + `sk`, Slovak formal address).
- Tables eager-load what a row shows, are paginated, and searchable/sortable columns must be real database columns. Destructive actions need confirmation.
- Tests use `Model::shouldBeStrict()`. Before finishing run `composer test`, `composer analyse`, `composer format`.
