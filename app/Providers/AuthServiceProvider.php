<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('isAdmin', function ($user) {
            return $user->current_team_id == $_ENV['TEAMS_MANAGER'];
        });

        $gate->define('isTeacher', function ($user) {
            return $user->current_team_id == $_ENV['TEAMS_TEACHER'];
        });

        $gate->define('isFinance', function ($user) {
            return $user->current_team_id == $_ENV['TEAMS_FINANCE'];
        });

        $gate->define('isSales', function ($user) {
            return $user->current_team_id == $_ENV['TEAMS_SALES'];
        });
    }
}
