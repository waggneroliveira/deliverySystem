<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasRoles, HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'active',
        'path_image',
        'sorting',
    ];

    public function products(){
        return $this->hasMany(Product::class, 'produtc_category');
    }
    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSorting($query)
    {
        return $query->orderByRaw("CASE WHEN active = 1 THEN sorting ELSE 999999 END ASC"); //Garante que os inativos sempre fiquem no final, forçando a ordenação correta.
    }
    
    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
