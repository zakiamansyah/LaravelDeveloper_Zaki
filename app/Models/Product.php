<?php

namespace App\Models;

use App\Trait\ProductTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ProductTrait;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
    ];
}
