<?php

namespace App\Repositories;

use App\Contracts\TransactionRepositoryInterface;
use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getAllTransactions()
    {
        return $this->transaction->get();
    }

    public function getTransactionById($id)
    {
        return $this->transaction->find($id);
    }

    public function createTransaction($request)
    {
        $data = [
            'transaction_id' => $request['transaction_id'],
            'quantity' => $request['quantity'],
            'payment_method' => $request['payment_method'],
            'status' => $request['status'],
            'amount' => $request['amount'],
            'transaction_date' => $request['transaction_date'],
        ];

        return $this->transaction->create($data);
    }

    public function updateTransaction($request, $id)
    {
        $data = [
            'transaction_id' => $request['transaction_id'],
            'quantity' => $request['quantity'],
            'payment_method' => $request['payment_method'],
            'status' => $request['status'],
            'amount' => $request['amount'],
            'transaction_date' => $request['transaction_date'],
        ];

        return $this->transaction->where('id', $id)->update($data);
    }

    public function deleteTransaction($id)
    {
        return $this->transaction->where('id', $id)->delete();
    }
}

