<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Warehouse extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'name',
        'address',
    ];

    protected $sortable = [
        'name',
        'address',
    ];

    protected $guarded = [
        'id',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }

    
    public function getRouteKeyName()
    {
        return 'name';
    }
}
