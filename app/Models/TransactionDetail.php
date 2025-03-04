<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transactions_detail';

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'payment_method',
        'status',
        'amount',
        'transaction_date'
    ];
}
