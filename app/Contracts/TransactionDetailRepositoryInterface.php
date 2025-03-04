<?php

namespace App\Contracts;

interface TransactionDetailRepositoryInterface
{
    public function getAllTransactionDetails();
    public function getTransactionDetailById($id);
    public function createTransactionDetail($request);
    public function updateTransactionDetail($request, $id);
    public function deleteTransactionDetail($id);
}

