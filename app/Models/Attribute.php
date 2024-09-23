<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['id',
        'name','image','type','attribute_catalogue_id'];

    public function attribute_catalogue(): BelongsTo
    {
        return $this->belongsTo(AttributeCatalogue::class, 'attribute_catalogue_id', 'id');
    }
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_attributes', 'attribute_id', 'product_id');

    }
}
