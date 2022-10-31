<table class="table table-striped table-inverse table-responsive">
    <thead>
        <tr>
            <td>#</td>
            <td>Product Name</td>
            <td>Quantity</td>
            <td>Unit Price</td>
            <td>Subtotal</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->orderdetails as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->product_qty }}</td>
                <td>{{ $item->product_price }}</td>
                <td>{{ $item->product_price * $item->product_qty }}</td>
            </tr>
        @endforeach
        <tr style="margin-bottom: 50px;">
            <td colspan="4">Total Payable Amount</td>
            <td>৳ {{ $order->total }}</td>
        </tr>

        <tr>
            <td colspan="50">
                <p class="text-primary">Billing Address:</p>
                <p>Recipent Name: {{ $order->billing->name }}</p>
                <p>Mobile Number: {{ $order->billing->phone_number }}</p>
                <p>Address: {{ $order->billing->address }}</p>
                <p>Upazila: {{ $order->billing->upazila->name }},
                    District: {{ $order->billing->district->name }}</p>
            </td>
        </tr>
    </tbody>
</table>
