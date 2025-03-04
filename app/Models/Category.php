<?php

namespace App\Models;

use App\Trait\CategoryTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CategoryTrait;

    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];
}
