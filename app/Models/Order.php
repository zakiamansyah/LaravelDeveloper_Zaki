<?php

namespace App\Models;

use App\Trait\OrderTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use OrderTrait;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'total_price',
        'shipping_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'order_id', 'id');
    }
}
