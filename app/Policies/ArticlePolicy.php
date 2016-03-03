<?php

namespace App\Policies;

use App\User;
use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
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

    public function before(User $user, $ability)
    {

        if($user->isAdmin()){
            return true;
        }
    }

    public function view(User $user, $ability)
    {

        return true; // allow all REGISTERED users
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function edit(User $user, Article $article)
    {
        return($user->isAdmin() || $article->isOwnedByCurrentUser());
    }

    public function update(User $user, Article $article)
    {
        return $this->edit($user, $article);
    }


}
