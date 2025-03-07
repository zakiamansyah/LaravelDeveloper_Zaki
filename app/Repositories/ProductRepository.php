<?php

namespace App\Repositories;

use App\Contracts\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAllProducts()
    {
        return $this->product->getAllProducts();
    }

    public function getProductById($id)
    {

        return $this->product->getProductById($id);
    }

    public function createProduct($request)
    {
        $data = [
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'stock' => $request['stock'],
        ];

        return $this->product->createProduct($data);
    }

    public function updateProduct($request, $id)
    {
        $data = [
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'stock' => $request['stock'],
        ];

        return $this->product->updateProduct($data, $id);
    }

    public function deleteProduct($id)
    {
        return $this->product->deleteProduct($id);
    }
}

