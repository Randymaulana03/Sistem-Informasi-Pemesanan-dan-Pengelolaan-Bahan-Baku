<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }} Ranss Store Computer</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Invoice Pesanan #{{ $order->id }}</h2>
    <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
    <p><strong>Telepon:</strong> {{ $order->customer_phone }}</p>
    <p><strong>Alamat:</strong> {{ $order->customer_address }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method ?? '-' }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Laptop</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->laptops as $laptop)
                <tr>
                    <td>{{ $laptop->name }}</td>
                    <td>Rp {{ number_format($laptop->pivot->price) }}</td>
                    <td>{{ $laptop->pivot->quantity }}</td>
                    <td>Rp {{ number_format($laptop->pivot->price * $laptop->pivot->quantity) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>Rp {{ number_format($order->total_price) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
