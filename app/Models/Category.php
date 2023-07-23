<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $sortable = [
        'name',
        'slug'
    ];

    protected $guarded = [
        'id',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
