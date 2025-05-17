<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slide extends Model
{
    use Notifiable, HasFactory,  LogsActivity;
    
    protected $table = 'slides';

    protected $fillable = [
        'path_image',
        'path_image_mobile',
        'title',
        'description',
        'sorting',
        'active',
        'link_youtube',
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
