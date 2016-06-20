<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Project;
use App\Endpoint;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // removing project
        Project::deleting(function ($project)
        {
            $project->endpoints()->delete();
        });

        // removing endpoint
        Endpoint::deleting(function ($endpoint)
        {
            $endpoint->parameters()->delete();
        });
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
}
