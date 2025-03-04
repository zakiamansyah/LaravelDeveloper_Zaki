<?php

namespace App\Repositories;

use App\Contracts\TransactionDetailRepositoryInterface;
use App\Models\TransactionDetail;

class TransactionDetailRepository implements TransactionDetailRepositoryInterface
{
    protected $transactionDetail;

    public function __construct(TransactionDetail $transactionDetail)
    {
        $this->transactionDetail = $transactionDetail;
    }

    public function getAllTransactionDetails()
    {
        return $this->transactionDetail->get();
    }

    public function getTransactionDetailById($id)
    {
        return $this->transactionDetail->find($id);
    }

    public function createTransactionDetail($request)
    {
        $data = [
            'transaction_id' => $request['transaction_id'],
            'quantity' => $request['quantity'],
            'payment_method' => $request['payment_method'],
            'status' => $request['status'],
            'amount' => $request['amount'],
            'transaction_date' => $request['transaction_date'],
        ];

        return $this->transactionDetail->create($data);
    }

    public function updateTransactionDetail($request, $id)
    {
        $data = [
            'transaction_id' => $request['transaction_id'],
            'quantity' => $request['quantity'],
            'payment_method' => $request['payment_method'],
            'status' => $request['status'],
            'amount' => $request['amount'],
            'transaction_date' => $request['transaction_date'],
        ];

        return $this->transactionDetail->where('id', $id)->update($data);
    }

    public function deleteTransactionDetail($id)
    {
        return $this->transactionDetail->where('id', $id)->delete();
    }
}

