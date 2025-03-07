<?php

namespace App\Trait;

trait ProductTrait
{
    public function getAllProducts(){
        
        return $this->with('category')->get(); 
    }

    public function getProductById($id){
        return $this->where('id', $id)->first();
    }

    public function createProduct($request){
        return $this->create($request);
    }

    public function updateProduct($request, $id){
        return $this->where('id', $id)->update($request);
    }

    public function deleteProduct($id){
        return $this->where('id', $id)->delete();
    }
}
