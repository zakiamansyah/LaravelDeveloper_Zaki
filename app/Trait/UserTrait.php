<?php

namespace App\Trait;

trait UserTrait
{
    public function getUserById($id){
        return $this->find($id);
    }

    public function getAllUser(){
        return $this->get();
    }
}
