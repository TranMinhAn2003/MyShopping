<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected  $fillable=[
        'user_id','product_id','name','quantity'
    ];
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
