<?php

namespace App\Policies;

use App\Almacen;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlmacenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\user  $model
     * @return mixed
     */
    public function view(User $user, Almacen $almacen)
    {
        //
         if($user->email == 'sistemas@mrollogistics.com.mx' || $user->email == 'direccionoperaciones@mrollogistics.com.mx' || $user->email == 'direcciongeneral@mrollogistics.com.mx' || $user->email == 'alan.mendez@mrollogistics.com.mx' )
        {
            return $almacen;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Almacen $almacen)
    {
        //
        if($user->email == 'sistemas@mrollogistics.com.mx' || $user->email == 'direccionoperaciones@mrollogistics.com.mx' || $user->email == 'direcciongeneral@mrollogistics.com.mx' || $user->email == 'alan.mendez@mrollogistics.com.mx' )
        {
            return $almacen;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\user  $model
     * @return mixed
     */
    public function update(User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\user  $model
     * @return mixed
     */
    public function delete(User $user, Almacen $almacen)
    {
        //
        if($user->email == 'sistemas@mrollogistics.com.mx' || $user->email == 'direccionoperaciones@mrollogistics.com.mx' || $user->email == 'direcciongeneral@mrollogistics.com.mx' || $user->email == 'alan.mendez@mrollogistics.com.mx' || $user->email == 'diego.gonzalez@mrollogistics.com.mx')
        {
            return $almacen;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\user  $model
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\user  $model
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}
