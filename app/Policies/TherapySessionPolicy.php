<?php

namespace App\Policies;

use App\Models\TherapySession;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TherapySessionPolicy
{
    use HandlesAuthorization;

    public function viewAll(): bool
    {
        return true;
    }

    public function view(): bool
    {
        return auth()->check();
    }

    public function create(User $user): bool
    {
        return $user->role === 1 || $user->role === 3;
    }

    public function update(User $user, TherapySession $therapySession): bool
    {
        return $user->role === 2 || $user->role === 3;
    }

    public function delete(User $user, TherapySession $therapySession): bool
    {
        return $user->id === $therapySession->user_id || $user->role === 3;
    }
}