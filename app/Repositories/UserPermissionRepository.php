<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPermissionRepository
{
    public function filterUsersByPermissions($users)
    {
        $user = Auth::user();

        // Se for Super, libera tudo (exceto usuário com id 1)
        if ($user->hasRole('Super') && $user->can('usuario.tornar usuario master')) {
            return $users->where('id', '<>', 1);
        }

        // Se não tiver permissão mínima de visualização, bloqueia
        if (!$user->can('usuario.visualizar')) {
            return 'forbidden';
        }

        // Se tiver permissão de ver outros usuários
        if ($user->can('usuario.visualizar outros usuarios')) {
            return $users->where('id', '<>', 1);
        }

        // Se só pode ver a si mesmo
        if ($user->can('usuario.visualizar')) {
            return $users->where('id', '<>', 1)
                        ->where('id', $user->id);
        }

        return $user;
    }

    public function usersWithPermissionsForEdit(){

        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can(['usuario.visualizar','usuario.editar'])){
            return 'forbidden';
        }
    }
}
