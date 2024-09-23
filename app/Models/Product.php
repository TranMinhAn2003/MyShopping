<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name',
        'description',
        'price','sku','quantity','category_id','is_featured','created_at'
    ];

    public function attributes(){
        return $this->belongsToMany(Attribute::class, 'product_attributes','product_id','attribute_id');
    }
    public function images(){
        return $this->hasMany(Image::class,'product_id','id');
    }
    public function mainImage()
    {
        return $this->hasOne(Image::class)->where('is_main', true);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
