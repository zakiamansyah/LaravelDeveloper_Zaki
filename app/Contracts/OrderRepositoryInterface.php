<?php

namespace App\Contracts;

interface OrderRepositoryInterface
{
    public function getAllOrder();

    public function getOrderById($id);

    public function createOrder($request);

    public function updateOrder($request, $id);

    public function deleteOrder($id);



}
