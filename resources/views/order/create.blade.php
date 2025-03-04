@extends('layout')

@section('content')
<h2>Add Order</h2>
<form method="POST" action="{{ route('orders.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Customer Name</label>
        <select name="user_id" class="form-control" required>
            <option value="">Select Customer</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    
    <h4>Transaction Details</h4>
    <table class="table table-bordered" id="transactionTable">
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <tr>
            <td><select name="transactions[0][product_id]" class="form-control" required>
                <option value="">Select Customer</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select></td>
            <td><input type="number" name="transactions[0][quantity]" class="form-control quantity" required></td>
            <td><input type="number" name="transactions[0][amount]" class="form-control amount" required></td>
            <td><input type="number" name="transactions[0][total]" class="form-control total" readonly></td>
            <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
        </tr>
    </table>

    <button type="button" class="btn btn-primary" id="addTransaction">Add Transaction</button>
    
    <div class="mb-3 mt-3">
        <label class="form-label">Total Amount</label>
        <input type="number" name="total_price" class="form-control" id="totalPrice" readonly required>
    </div>

    <div class="mb-3 mt-3">
        <label class="form-label">Shipping Address</label>
        <textarea name="shipping_address" class="form-control" id="shippingAddress" required>
            {{ old('shipping_address') }}
        </textarea>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let index = 1;
    
    document.getElementById('addTransaction').addEventListener('click', function () {
        let table = document.getElementById('transactionTable');
        let newRow = document.createElement('tr');
        let products = JSON.parse('{!! $products !!}');
        products = products.map(product => `<option value="${product.id}">${product.name}</option>`).join('');        
        newRow.innerHTML = `
            <td><select name="transactions[${index}][product_id]" class="form-control" required>
                <option value="">Select Product</option>
                ${products}
            </select></td>
            <td><input type="number" name="transactions[${index}][quantity]" class="form-control quantity" required></td>
            <td><input type="number" name="transactions[${index}][amount]" class="form-control amount" required></td>
            <td><input type="number" name="transactions[${index}][total]" class="form-control total" readonly></td>
            <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
        `;
        table.appendChild(newRow);
        index++;
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('removeRow')) {
            event.target.closest('tr').remove();
            calculateTotal();
        }
    });

    document.addEventListener('input', function (event) {
        if (event.target.classList.contains('quantity') || event.target.classList.contains('amount')) {
            let row = event.target.closest('tr');
            let quantity = row.querySelector('.quantity').value;
            let price = row.querySelector('.amount').value;
            let total = row.querySelector('.total');

            total.value = quantity * price;
            calculateTotal();
        }
    });

    function calculateTotal() {
        let totalPrice = 0;
        document.querySelectorAll('.total').forEach(function (input) {
            totalPrice += parseFloat(input.value) || 0;
        });
        document.getElementById('totalPrice').value = totalPrice;
    }
});
</script>
@endsection
