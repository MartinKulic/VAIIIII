<?php

namespace App\Policies;

use App\Models\Fav;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FavPolicy
{


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Fav $fav): bool
    {
        return $user->id === $fav->autor_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Fav $fav): bool
    {
        return $user->id === $fav->autor_id;
    }

}
