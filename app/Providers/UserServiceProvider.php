<?php

namespace App\Providers;

use App\Events\RegisterUserEvent;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::creating(function (User $user) {
            $user->token = str_random(User::ITEM_TOKEN_LENGTH);
        });

        User::created(function (User $user) {
            event(new RegisterUserEvent($user));
        });

        User::deleting(function (User $user) {
            $user->teams()->detach();
            $user->projects()->detach();
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
