<p><strong>Thank you for your purchase!</strong></p>
<p>Here are the details of your order:</p>
<ul>
    @foreach ($products as $product)
        <li>{{ $product->name }} - {{ $product->pivot->quantity }} units</li>
    @endforeach
</ul>
<p><strong>Shipping Address:</strong> {{ $order->address }}</p>
<p><strong>Total Purchase:</strong> ${{ $order->total_price }}</p>
