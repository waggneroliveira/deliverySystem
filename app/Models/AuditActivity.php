<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditActivity extends Model
{
    use HasFactory;

    public static function getModelName($subjectType)
    {
        switch ($subjectType) { 
           
            case Taxa::class:
                return 'Taxas';
            case ServiceLocation::class:
                return 'Locais de Atendimentos';
            case Newsletter::class:
                return 'Newsletter';
            case Product::class:
                return 'Produtos';
            case ProductCategory::class:
                return 'Categorias dos Produtos';
            case Slide::class:
                return 'Slides';
            case User::class:
                return __('blades/audit.users');
            case Role::class:
                return __('blades/audit.roles');
            case SettingEmail::class:
                return __('blades/audit.setting_email');
            default:
                return __('blades/audit.system');

        }
    }
}
