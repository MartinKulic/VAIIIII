<?php
namespace App\Policies;

use App\Models\Report;
use App\Models\User;

class ReportPolicy{

    public function before(User $user, $ability)
    {
        if ($user->role === 'a') {
            return true; // Admin môže všetko
        }
        return null;
    }

    public function create(User $user){
        return $user->role !== 'r';
    }
    public function delete(User $user, Report $report){
        return $user->id === $report->user_id && $user->role !== 'r';
    }


}
