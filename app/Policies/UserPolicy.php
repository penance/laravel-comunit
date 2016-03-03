<?php

namespace App\Policies;

use App\User;
use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Run before all gate athorizations, allow super admins automatically
     *
     * @param User $user
     * @param $ability
     * @return bool|null
     */
    public function before(User $user, $ability)
    {
        if ($user->level_id > 1){
            return true;
        }
    }


    /**
     * Method to authorise editing of user data
     *
     * @param User $user
     * @param User $userData
     * @return bool
     */
    public function update(User $user, User $userData)
    {
        return $user->id === $userData->id;
    }

    /**
     * Method to authorise viewing of the users list
     * This will in fact allow any logged user to see the list,
     * because otherwise it is not run at all
     *
     * must
     *
     * @param User $user
     * @return bool
     */
    public function view (User $user)
    {
        return true;
    }

    public function updateAccessLevel(User $user)
    {
        return $user->isAdmin();
    }

    public function delete(User $user)
    {
        return $user->isAdmin();
    }
}
