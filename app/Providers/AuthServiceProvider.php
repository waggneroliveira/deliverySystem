<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Scopes\SuperAdminScope;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(function (User $user, $ability) {
            // Verifica se o usuário está "fora" do escopo de SuperAdmin, ou seja, ele é super
            $user->withGlobalScope('Super', new SuperAdminScope());
    
            // Agora, se o usuário não tiver o escopo aplicado (ou seja, for super), ele terá todas as permissões
            if ($user->id == 1 && $user->is_super) { 
                return true; // Dá todas as permissões ao super
            }
        });
    }
}
