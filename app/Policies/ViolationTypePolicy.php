<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ViolationType;
use Illuminate\Auth\Access\Response;

class ViolationTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return (auth()->user()->isMarketSupervisor()) && auth()->user()->appSettings()->enable_violations == 1;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ViolationType $violationType): bool
    {
        return (auth()->user()->isMarketSupervisor()) && auth()->user()->appSettings()->enable_violations == 1;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return (auth()->user()->isMarketSupervisor()) && auth()->user()->appSettings()->enable_violations == 1;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ViolationType $violationType): bool
    {
        return (auth()->user()->isMarketSupervisor()) && auth()->user()->appSettings()->enable_violations == 1;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ViolationType $violationType): bool
    {
        return (auth()->user()->isMarketSupervisor()) && auth()->user()->appSettings()->enable_violations == 1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ViolationType $violationType): bool
    {
        return (auth()->user()->isMarketSupervisor()) && auth()->user()->appSettings()->enable_violations == 1;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ViolationType $violationType): bool
    {
       return (auth()->user()->isMarketSupervisor()) && auth()->user()->appSettings()->enable_violations == 1;
    }
}
