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
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }

}