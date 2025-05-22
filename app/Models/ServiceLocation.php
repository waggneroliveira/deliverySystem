<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceLocation extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'taxa_id',
        'name',
        'active',
        'sorting',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }

    public function taxa(){
        return $this->belongsTo(Taxa::class);
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }
    
    public function scopeSorting($query){
        return $query->orderBy('sorting', 'asc');
    }
}
