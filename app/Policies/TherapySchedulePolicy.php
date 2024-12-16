<?php
namespace App\Policies;

use App\Models\TherapySchedule;
use App\Models\User;

class TherapySchedulePolicy
{

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(User $user, TherapySchedule $therapySchedule): bool
    {
        return $user->id === $therapySchedule->therapist_id || $user->role === 3;
    }

    public function create(User $user): bool
    {
        return $user->role === 2 || $user->role === 3;
    }

    public function update(User $user, TherapySchedule $therapySchedule): bool
    {
        return $user->id === $therapySchedule->therapist_id || $user->role === 3;
    }

    public function delete(User $user, TherapySchedule $therapySchedule): bool
    {
        return $user->id === $therapySchedule->therapist_id || $user->role === 3;
    }
}