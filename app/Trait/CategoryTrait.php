<?php

namespace App\Trait;

trait CategoryTrait
{
    public function getAllCategories(){
        return $this->get();
    }

    public function getCategoryById($id){
        return $this->where('id', $id)->first();
    }

    public function createCategory($request){
        return $this->create($request);
    }

    public function updateCategory($request, $id){
        return $this->where('id', $id)->update($request);
    }

    public function deleteCategory($id){
        return $this->where('id', $id)->delete();
    }
}
