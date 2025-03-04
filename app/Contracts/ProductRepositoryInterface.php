<?php

namespace App\Contracts;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById($id);
    public function createProduct($request);
    public function updateProduct($request, $id);
    public function deleteProduct($id);
}

