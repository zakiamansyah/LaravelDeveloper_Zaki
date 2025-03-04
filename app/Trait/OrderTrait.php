<?php

namespace App\Trait;

trait OrderTrait
{
    public function getAllOrder(){
        return $this->with('transaction.details')->get();
    }

    public function getOrderById($id){
        return $this->where('id', $id)->first();
    }

    public function createOrder($request){
        return $this->create($request);
    }

    public function updateOrder($request, $id){
        return $this->where('id', $id)->update($request);
    }

    public function deleteOrder($request, $id){
        return $this->where('id', $id)->delete();
    }
}
