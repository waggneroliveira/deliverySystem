<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'promotion_value',
        'amount',
        'active',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function scopeActive(){
        return $this->where('active', 1);
    }
    
    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
