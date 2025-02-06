<?php
namespace App\Policies;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $who, User $changeUser): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $who, User $changeUser): bool
    {
        return $who->id === $changeUser->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $who, User $changeUser): bool
    {
        return $who->id === $changeUser->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $who, User $changeUser): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $who, User $changeUser): bool
    {
        return false;
    }

    public function changeRole(User $who, User $changeUser): bool{
        return $who->role === 'a' && $who->id !== $changeUser->id;
    }

    public function createImg(User $user): bool {
        return $user->role !== 'r';
    }
}
