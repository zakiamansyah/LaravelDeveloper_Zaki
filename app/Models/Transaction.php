<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'order_id',
        'transaction_number'
    ];

    public function details(){
        return $this->hasMany(TransactionDetail::class);
    }
}
