<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'subcategory_id',
        'price',
        'discount',
        'is_in_stock',
        'description',
        'image_list'
    ];
    
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id', 'id');
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_values', 'product_id', 'attribute_id')
            ->withPivot('value')->withTimestamps();
    }
    // Scope query category
    public function scopeFindByCategoryId($query, $categoryId)
    {
        return $query->whereHas('subcategory.category', function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        });
    }
    // Scope query subcategory
    public function scopeFindBySubcategoryId($query, $subcategoryId)
    {
        return $query->whereHas('subcategory', function ($query) use ($subcategoryId) {
            $query->where('id', $subcategoryId);
        });
    }

}