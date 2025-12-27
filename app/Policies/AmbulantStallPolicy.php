<?php

namespace App\Policies;

use App\Models\AmbulantStall;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AmbulantStallPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->isMarketSupervisor()  || auth()->user()->isMarketSpecialist();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AmbulantStall $ambulantStall): bool
    {
        return auth()->user()->isMarketSupervisor()  || auth()->user()->isMarketSpecialist();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->isMarketSupervisor();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AmbulantStall $ambulantStall): bool
    {
        return auth()->user()->isMarketSupervisor();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AmbulantStall $ambulantStall): bool
    {
        return auth()->user()->isMarketSupervisor() ;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AmbulantStall $ambulantStall): bool
    {
        return auth()->user()->isMarketSupervisor() ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AmbulantStall $ambulantStall): bool
    {
        return auth()->user()->isMarketSupervisor() ;
    }
}
