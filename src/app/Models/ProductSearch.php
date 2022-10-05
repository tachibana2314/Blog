<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductSearch extends Model
{
    protected $fillable = [
        'sort',
        'direction',
        'keyword',
        'name',
        'm_product_category_id',
        'price',
        'calory',
        'status',
        'order',
        'url',
        'limited_flg',
        'start_date',
        'end_date',
    ];

    public function getQuery()
    {
        return new Product;
    }
}
