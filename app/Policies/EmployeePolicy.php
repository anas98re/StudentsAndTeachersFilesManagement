<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAllEmoloyees(User $user)
    {
        switch ($user->role) {
            case '1':
                return true;
            case '2':
                return false;
            case '3':
                return false;
            default:
                return true;
        }
    }
}
