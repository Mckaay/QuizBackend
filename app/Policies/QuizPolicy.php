<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class QuizPolicy
{
    use HandlesAuthorization;

    public function create(?User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(?User $user): bool
    {
        return $user->isAdmin();
    }

    public function delete(?User $user): bool
    {
        return $user->isAdmin();
    }
}
