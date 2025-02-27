<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'path_image',
        'path_image_mobile',
        'title',
        'description',
        'sorting',
        'active',
    ];

    public function scopeActive(){
        return $this->where('active', 1);
    }

    public function scopeSorting(){
        return $this->orderBy('sorting', 'asc');
    }

    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
