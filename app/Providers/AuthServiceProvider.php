<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Note; // Asegúrate de que los modelos están importados correctamente
use App\Policies\NotePolicy;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
            // Registra aquí tu política
        Note::class => NotePolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //

    }

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
