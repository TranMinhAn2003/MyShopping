<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipient_name','phone','totals','payments','address','note','status','user_id'
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }
}
