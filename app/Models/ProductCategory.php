<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'active',
        'path_image',
        'sorting',
    ];

    public function scopeActive(){
        return $this->where('active', 1);
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
