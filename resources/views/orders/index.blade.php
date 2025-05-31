<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pesanan - Ranss Store Computer</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        /* CSS custom */
        table.table-hover tbody tr:hover {
            background-color: #e9f5ff;
            transition: background-color 0.3s ease;
        }
        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }
        .table-responsive {
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 123, 255, 0.1);
        }
        .alert-dismissible .btn-close {
            position: absolute;
            top: 0.75rem;
            right: 1rem;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }
        .alert-dismissible .btn-close:hover {
            opacity: 1;
        }
        .btn-info {
            background-color: #0dcaf0;
            border-color: #0dcaf0;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-info:hover, .btn-info:focus {
            background-color: #0bb8d9;
            border-color: #0bb8d9;
        }
        form.d-flex input[type="search"] {
            max-width: 250px;
            border-radius: 20px 0 0 20px;
            border-right: none;
        }
        form.d-flex button {
            border-radius: 0 20px 20px 0;
            border-left: none;
        }
        h1 {
            font-size: 2.5rem;
            color: black;
        }
        @media (max-width: 576px) {
            h1 {
                font-size: 1.8rem;
                color: black;
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4 text-center fw-bold text-dark">Daftar Pesanan</h1>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
       <!-- Tombol Kembali di atas -->
<div class="mb-3">
    <a href="{{ route('dashboardUser') }}" class="btn btn-secondary shadow-sm">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard User
    </a>
</div>

<!-- Tombol Buat Pesanan Baru + Form Cari di bawah -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <a href="{{ route('orders.create') }}" class="btn btn-custom shadow-sm">
        <i class="bi bi-plus-circle" style="color: #212529;"></i> Buat Pesanan Baru
    </a>


    <form class="d-flex" role="search" method="GET" action="{{ route('orders.index') }}">
        <input class="form-control" type="search" name="search" placeholder="" aria-label="Search" value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Cari</button>
    </form>
</div>


        

        <div class="table-responsive shadow-sm rounded bg-white">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col" class="text-end">Total Harga</th>
                        <th scope="col" class="text-center">Tanggal Pesan</th>
                        <th scope="col" class="text-center" colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <td class="text-center fw-semibold">{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td class="text-end text-success fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info shadow-sm" title="Detail Pesanan">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Hapus Pesanan">
                                    <i class="bi bi-trash"></i> Batalkan Pesanan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted fst-italic">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
