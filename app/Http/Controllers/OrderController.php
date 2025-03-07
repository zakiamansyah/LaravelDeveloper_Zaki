<?php

namespace App\Http\Controllers;

use App\Contracts\AuthRepositoryInterface;
use App\Contracts\OrderRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $authRepository;
    protected $productRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, AuthRepositoryInterface $authRepository, ProductRepositoryInterface $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->authRepository = $authRepository;
        $this->productRepository = $productRepository;
    }

    public function getAllOrder(){

        $orders = $this->orderRepository->getAllOrder();

        return view('order.index', compact('orders'));
    }

    public function getOrderById($id){
        $order = $this->orderRepository->getOrderById($id);

        if (!$order) {
            return redirect()->route('order.index')->with('error', 'Order not found');
        }

        return view('order.show', compact('order'));
    }

    public function createOrder(){
        $users = $this->authRepository->getAllUser();
        $products = $this->productRepository->getAllProducts();

        return view('order.create', compact('users', 'products'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id'          => 'required|exists:users,id',
            'shipping_address' => 'required|string',
            'total_price' => 'required|numeric',
            'transactions'               => 'required|array|min:1',
            'transactions.*.product_id'  => 'required|exists:products,id',
            'transactions.*.total' => 'required|numeric',
            'transactions.*.amount' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput();
        } 

        $check = $this->orderRepository->createOrder($request);
        if($check){
            return redirect()->route('order');
        }else{
            return redirect()->back()->withInput();
        }
    }

    public function editOrder($id)
    {
        $order = $this->orderRepository->getOrderById($id);
        if (!$order) {
            return redirect()->route('order')->with('error', 'Order not found');
        }

        $users = $this->authRepository->getAllUser();
        $products = $this->productRepository->getAllProducts();

        return view('order.edit', compact('order', 'users', 'products'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_id'       => 'required|exists:products,id',
            'order_number'     => 'required|unique:orders,order_number,' . $id,
            'status'           => 'required|string',
            'total_price'      => 'required|numeric|min:0',
            'shipping_address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $updateResult = $this->orderRepository->updateOrder($request, $id);

        if ($updateResult) {
            return redirect()->route('order')->with('success', 'Order updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update order');
    }

    public function delete($id)
    {
        $order = $this->orderRepository->deleteOrder($id);

        if (!$order) {
            return redirect()->route('order')->with('error', 'Order not found or could not be deleted.');
        }

        return redirect()->route('order')->with('success', 'Order deleted successfully.');
    }
}
