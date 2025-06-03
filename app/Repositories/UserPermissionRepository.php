<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPermissionRepository
{
    public function filterUsersByPermissions($users)
    {
        $user = Auth::user();

        // Se for Super, vê tudo 
        if ($user->hasRole('Super')) {
            return $users->where('id', '<>', 1); 
        }

        // Se for Master (tem permissão específica), vê todos menos o Super
        if ($user->can('usuario.tornar usuario master')) {
            return $users->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'Super');
            })->where('id', '<>', 1);
        }

        // Se não tem permissão mínima de visualização
        if (!$user->can('usuario.visualizar')) {
            return 'forbidden';
        }

        // Se pode ver outros usuários
        if ($user->can('usuario.visualizar outros usuarios')) {
            return $users->where('id', '<>', 1);
        }

        // Se só pode ver a si mesmo
        return $users->where('id', $user->id)->where('id', '<>', 1);
    }

    public function usersWithPermissionsForEdit(){

        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can(['usuario.visualizar','usuario.editar'])){
            return 'forbidden';
        }
    }
}
