<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Role;
use Illuminate\Support\ServiceProvider;

class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Project::creating(function (Project $project) {
            $project->token = str_random(Project::ITEM_TOKEN_LENGTH);
        });

        Project::created(function (Project $project) {
            $role = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();

            $project->users()->attach(auth()->user(), [
                'is_owner'         => true,
                'is_valid'         => true,
                'validation_token' => str_random(Project::ITEM_TOKEN_LENGTH),
                'role_id'          => $role->id,
            ]);
        });

        Project::deleting(function (Project $project) {
            $project->teams()->detach();
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
