<?php

namespace App\Models;

use App\Models\ProductStock;
use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{

    use HasRoles, HasFactory, LogsActivity;
    
    protected $fillable = [
        'produtc_category',
        'title',
        'slug',
        'active',
        'promotion',
        'highlight_home',
        'sorting',
        'description',
        'path_image',
    ];

    public function categories(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function stocks(){
        return $this->hasMany(ProductStock::class, 'product_id');
    }

    public function scopeActive(){
        return $this->where('products.active', 1);
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
