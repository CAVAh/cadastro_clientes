<?php

namespace App\Policies;

use App\Pais;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaisPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any pais.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the pais.
     *
     * @param  \App\User  $user
     * @param  \App\Pais  $pais
     * @return mixed
     */
    public function view(User $user, Pais $pais)
    {
        //
    }

    /**
     * Determine whether the user can create pais.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the pais.
     *
     * @param  \App\User  $user
     * @param  \App\Pais  $pais
     * @return mixed
     */
    public function update(User $user, Pais $pais)
    {
        //
    }

    /**
     * Determine whether the user can delete the pais.
     *
     * @param  \App\User  $user
     * @param  \App\Pais  $pais
     * @return mixed
     */
    public function delete(User $user, Pais $pais)
    {
        //
    }

    /**
     * Determine whether the user can restore the pais.
     *
     * @param  \App\User  $user
     * @param  \App\Pais  $pais
     * @return mixed
     */
    public function restore(User $user, Pais $pais)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the pais.
     *
     * @param  \App\User  $user
     * @param  \App\Pais  $pais
     * @return mixed
     */
    public function forceDelete(User $user, Pais $pais)
    {
        //
    }
}
