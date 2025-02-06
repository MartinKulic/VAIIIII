<?php
namespace App\Policies;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Ramsey\Uuid\Type\Integer;

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

    public function changeRole(User $user, User $changeUser): bool{
        return $user->role === 'a' && $user->id !== $changeUser->id;
    }

    public function createImg(User $user): bool {
        return $user->role !== 'r';
    }
    public function manageReports (User $user): bool{
        return $user->role === 'a';
    }
    public function viewReport (User $user): bool{
        return $user->role === 'a';
    }
    public function createReport (User $user): bool{
        return $user->role !== 'r';
    }
}
