<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use App\User;

use App\Policies\ArticlePolicy;
use App\Article;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'     => 'App\Policies\ModelPolicy',
        User::class     => UserPolicy::class,
        Article::class  => ArticlePolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('global.create', 'App\Policies\GlobalPolicy@create');

        //
    }
}
