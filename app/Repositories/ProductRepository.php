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

        return response()->json($this->product->getProductById($id), 200);
    }

    public function createProduct($request)
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
        ];

        return response()->json($this->product->createProduct($data), 200);
    }

    public function updateProduct($request, $id)
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
        ];

        return response()->json($this->product->updateProduct($data, $id), 200);
    }

    public function deleteProduct($id)
    {
        return response()->json($this->product->deleteProduct($id), 200);
    }
}

