<?php

namespace App\Repositories;

use App\Contracts\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    protected $order;
    protected $transaction;
    protected $transactionDetail;
    

    public function __construct(Order $order, Transaction $transaction, TransactionDetail $transactionDetail)
    {
        $this->order = $order;
        $this->transaction = $transaction;
        $this->transactionDetail = $transactionDetail;
    }

    public function getAllOrder()
    {
        return $this->order->getAllOrder();

        // return response()->json($this->order->getAllOrder(), 200);
    }

    public function getOrderById($id)
    {
        return $this->order->getOrderById($id);
    }

    public function createOrder($request)
    {
        DB::beginTransaction(); // Start transaction

        try {
            // Create Order
            $dataOrder = [
                'user_id' => $request->input('user_id'),
                'order_number' => $this->generateOrderNumber(),
                'status' => 'pending',
                'total_price' => $request->input('total_price'),
                'shipping_address' => $request->input('shipping_address')
            ];

            $order = $this->order->createOrder($dataOrder);

            // Create Transaction
            $dataTransaction = [
                'order_id' => $order->id,
                'transaction_number' => $this->generateTransactionNumber()
            ];

            $transaction = $this->transaction->create($dataTransaction);

            $details = $request->input('transactions');
            $dataTransactionDetail = [];

            foreach ($details as $detail) {
                $dataTransactionDetail[] = [
                    'transaction_id' => $transaction->id,
                    'product_id' => $detail['product_id'],
                    'quantity' => $detail['quantity'],
                    'amount' => $detail['amount']
                ];
            }

            $this->transactionDetail->insert($dataTransactionDetail);

            DB::commit();

            return response()->json(['message' => 'Order created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create order', 'message' => $e->getMessage()], 500);
        }
    }


    public function updateOrder($request, $id)
    {
        $order = $this->order->find($id);

        if (!$order) {
            return false;
        }

        $order->update([
            'product_id'       => $request->product_id,
            'order_number'     => $request->order_number,
            'status'           => $request->status,
            'total_price'      => $request->total_price,
            'shipping_address' => $request->shipping_address,
        ]);

        return true;
    }

    public function deleteOrder($id){
        $order = $this->order->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 200);
    }

    public static function generateOrderNumber()
    {
        $yearMonth = date('Ym');

        $lastOrder = Order::where('order_number', 'LIKE', "HMO{$yearMonth}%")
                        ->latest('order_number')
                        ->first();

        $lastNumber = $lastOrder ? intval(substr($lastOrder->order_number, -4)) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        return "HMO{$yearMonth}{$newNumber}";
    }

    public static function generateTransactionNumber()
    {
        $yearMonth = date('Ym');

        $lastTransaction = Transaction::where('transaction_number', 'LIKE', "HMT{$yearMonth}%")
                                    ->latest('transaction_number')
                                    ->first();

        $lastNumber = $lastTransaction ? intval(substr($lastTransaction->transaction_number, -4)) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        return "HMT{$yearMonth}{$newNumber}";
    }

}
