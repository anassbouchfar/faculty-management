<?php

namespace App\Providers;

use App\Note;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Note::class => 'App\Policies\NotePolicy',
        'App\Emploi' => 'App\Policies\EmploiPolicy',
        'App\Cv' => 'App\Policies\CVPolicy',
        'App\Cour' => 'App\Policies\CourPolicy',
        'App\Offre' => 'App\Policies\OffrePolicy',
        'App\Annonce' => 'App\Policies\EmploiPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
    }
}
