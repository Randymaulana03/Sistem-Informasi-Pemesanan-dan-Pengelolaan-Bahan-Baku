<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail #{{ $order->id }} Ranss Store Computer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
        }
        h1 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: black;
            text-align: center;
        }
        .btn-secondary {
            margin-bottom: 1.5rem;
        }
        .info-section {
            background-color: #ffffff;
            padding: 1.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .info-section h4 {
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 0.3rem;
            margin-bottom: 1rem;
        }
        .table thead {
            background-color: #0d6efd;
            color: #fff;
        }
        .table tbody tr:hover {
            background-color: #e9f5ff;
            transition: background-color 0.3s ease;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .total-row {
            background-color: #f1f9ff;
            font-size: 1.1rem;
        }
        .btn-pdf {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .btn-pdf:hover {
            background-color: #bb2d3b;
            border-color: #bb2d3b;
            color: #fff;
        }
        @media (max-width: 576px) {
            .info-section {
                padding: 1rem 1rem;
            }
            h1 {
                font-size: 1.8rem;
                color: black;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1>Detail Pesanan #{{ $order->id }}</h1>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary shadow-sm">
            &larr; Kembali ke Daftar Pesanan
        </a>

        <div class="info-section">
            <h4>Informasi Pelanggan</h4>
            <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
            <p><strong>Telepon:</strong> {{ $order->customer_phone ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $order->customer_address ?? '-' }}</p>
            <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
             <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method ?? '-' }}</p>
        </div>

        <div class="info-section">
            <h4>Daftar Laptop yang Dipesan</h4>
           <div class="table-responsive">
    <table class="table table-bordered align-middle mb-0">
        <thead>
            <tr>
                <th>Nama Laptop</th>
                <th class="text-end">Harga per Unit</th>
                <th class="text-center">Jumlah</th>
                <th>Spesifikasi</th> <!-- Tambah kolom spesifikasi -->
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->laptops as $laptop)
            <tr>
                <td>{{ $laptop->name }}</td>
                <td class="text-end">Rp {{ number_format($laptop->pivot->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $laptop->pivot->quantity }}</td>
                <td>
                    <ul class="mb-0">
                        @foreach($laptop->components as $component)
                            <li>{{ $component->name }} ({{ $component->pivot->quantity }})</li>
                        @endforeach
                    </ul>
                </td>
                <td class="text-end">Rp {{ number_format($laptop->pivot->price * $laptop->pivot->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4" class="text-end fw-bold">Total Harga</td>
                <td class="text-end fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</div>


            <a href="{{ route('orders.pdf', $order->id) }}" class="btn btn-pdf mt-3 shadow-sm" target="_blank">
                <i class="bi bi-file-earmark-pdf-fill me-2"></i> Download PDF
            </a>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</body>
</html>
