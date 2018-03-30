<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\Team;
use Illuminate\Support\ServiceProvider;

class TeamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Team::creating(function (Team $team) {
            $team->token = str_random(Team::ITEM_TOKEN_LENGTH);
        });

        Team::created(function (Team $team) {
            $role = Role::where('alias', Team::TEAM_OWNER_ROLE_ALIAS)->first();

            $team->users()->attach(auth()->user(), [
                'is_owner'         => true,
                'is_valid'         => true,
                'validation_token' => str_random(Team::ITEM_TOKEN_LENGTH),
                'role_id'          => $role->id,
            ]);
        });

        Team::deleting(function (Team $team) {
            $team->projects()->detach();
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
