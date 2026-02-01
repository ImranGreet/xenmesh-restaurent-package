<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_en',
        'name_bn',
        'category_id',
        'unit_id',
        'price',
        'stock',
        'status',
        'description_en',
        'description_bn',
        'product_thumbnail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $appends = ['product_thumbnail_url'];

    public function getProductThumbnailUrlAttribute()
    {
        return $this->product_thumbnail
            ? asset('storage/' . $this->product_thumbnail)
            : null;
    }
}
