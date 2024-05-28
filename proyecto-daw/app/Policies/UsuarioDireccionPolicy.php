<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Usuario_Direccion;
use Illuminate\Auth\Access\Response;

class UsuarioDireccionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Usuario_Direccion $usuarioDireccion): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Usuario_Direccion $usuarioDireccion): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Usuario_Direccion $usuarioDireccion): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Usuario_Direccion $usuarioDireccion): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Usuario_Direccion $usuarioDireccion): bool
    {
        //
    }
}
