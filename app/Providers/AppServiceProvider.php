<?php

namespace App\Providers;

use App\User;
use Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       $this->composeViews();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function composeViews ()
    {
        view()->composer('common.form.selectUsersField', function ($view){
            if (Auth::check()){
                $users = User::where('id', '<>', Auth::user()->id)->lists('name', 'id');
            } else {
                $users = User::lists('name', 'id');
            }

            $view->with('userList', $users);
        });
    }
}
