<?php

namespace App\Policies;

use App\Embarque;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmbarquePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user, Embarque $embarque)
    {
        //
        if($user->rol === '2' ||  $user->rol === '1')
        {
            return $embarque;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Embarque  $embarque
     * @return mixed
     */
    public function view(User $user, Embarque $embarque)
    {
        //
        if($user->rol === '1' || $user->rol === '2')
        {
            return $embarque->user_id;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Embarque $embarque)
    {
        //
        if($user->email == 'sistemas@mrollogistics.com.mx' ||$user->email === 'diego.gonzalez@mrollogistics.com.mx'  || $user->email == 'direccionoperaciones@mrollogistics.com.mx' || $user->email == 'direcciongeneral@mrollogistics.com.mx' || $user->email == 'alan.mendez@mrollogistics.com.mx' )
        {
            return $embarque;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Embarque  $embarque
     * @return mixed
     */
    public function update(User $user, Embarque $embarque)
    {
        // Revisa si el usuario autenticado puede actualizar el embarque
        if($user->email == 'sistemas@mrollogistics.com.mx' || $user->email === 'diego.gonzalez@mrollogistics.com.mx' || $user->email == 'direccionoperaciones@mrollogistics.com.mx' || $user->email == 'direcciongeneral@mrollogistics.com.mx' || $user->email == 'alan.mendez@mrollogistics.com.mx' )
        {
            return $embarque;
        }

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Embarque  $embarque
     * @return mixed
     */
    public function delete(User $user, Embarque $embarque)
    {
        //
        if($user->email == 'sistemas@mrollogistics.com.mx' || $user->email == 'direccionoperaciones@mrollogistics.com.mx' || $user->email == 'direcciongeneral@mrollogistics.com.mx' || $user->email == 'alan.mendez@mrollogistics.com.mx' )
        {
            return $embarque;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Embarque  $embarque
     * @return mixed
     */
    public function restore(User $user, Embarque $embarque)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Embarque  $embarque
     * @return mixed
     */
    public function forceDelete(User $user, Embarque $embarque)
    {
        //
    }
}
