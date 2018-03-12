<?php

namespace App\Providers;

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
            $user->password = Hash::make($user->getAttribute('password'));
            $user->token = str_random(User::ITEM_TOKEN_LENGTH);
        });

        User::updating(function (User $user) {
            $user->password = bcrypt($user->getDirty()['password']);
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
