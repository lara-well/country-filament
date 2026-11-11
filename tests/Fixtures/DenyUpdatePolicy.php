<?php

declare(strict_types=1);

namespace Larawell\CountryFilament\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;

/**
 * Allows everything except changing records; used to prove actions honour the model policy.
 */
final class DenyUpdatePolicy
{
    public function viewAny(mixed $user): bool
    {
        return true;
    }

    public function view(mixed $user, Model $record): bool
    {
        return true;
    }

    public function create(mixed $user): bool
    {
        return true;
    }

    public function update(mixed $user, Model $record): bool
    {
        return false;
    }

    public function delete(mixed $user, Model $record): bool
    {
        return true;
    }

    public function deleteAny(mixed $user): bool
    {
        return true;
    }

    public function reorder(mixed $user): bool
    {
        return true;
    }
}
