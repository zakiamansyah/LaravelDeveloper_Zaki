<?php

namespace App\Contracts;

interface TransactionRepositoryInterface
{
    public function getAllTransactions();
    public function getTransactionById($id);
    public function createTransaction($request);
    public function updateTransaction($request, $id);
    public function deleteTransaction($id);
}

