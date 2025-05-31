<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order Ranss Store Computer</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Buat Pesanan Baru</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="customer_name" class="form-label fw-semibold">Nama Pelanggan <span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name') }}" required />
                    <div class="invalid-feedback">Nama pelanggan wajib diisi.</div>
                </div>
                <div class="col-md-6">
                    <label for="customer_phone" class="form-label fw-semibold">No. Telepon</label>
                    <input
                        type="tel"
                        name="customer_phone"
                        id="customer_phone"
                        class="form-control"
                        value="{{ old('customer_phone') }}"
                        pattern="^[0-9+\-\s]*$"
                        placeholder="0812xxxxxxx"
                    />
                    <div class="invalid-feedback">Masukkan nomor telepon yang valid.</div>
                </div>
            </div>

            <div class="mb-4">
                <label for="customer_address" class="form-label fw-semibold">Alamat</label>
                <textarea
                    name="customer_address"
                    id="customer_address"
                    class="form-control"
                    rows="3"
                    placeholder="Masukkan alamat lengkap"
                >{{ old('customer_address') }}</textarea>
            </div>
            <div class="mb-4">
            <label for="payment_method" class="form-label fw-semibold">Metode Pembayaran <span class="text-danger">*</span></label>
            <select name="payment_method" id="payment_method" class="form-select" required>
                <option value="" disabled selected>-- Pilih Metode Pembayaran --</option>
                <option value="COD" {{ old('payment_method') == 'COD' ? 'selected' : '' }}>COD</option>
            </select>
            <div class="invalid-feedback">Metode pembayaran wajib dipilih.</div>
        </div>

            <h3 class="mb-3">Pilih Laptop</h3>

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Laptop</th>
                            <th>Harga</th>
                            <th style="width: 180px;">Jumlah Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laptops as $laptop)
                        <tr>
                            <td>{{ $laptop->name }}</td>
                            <td class="text-success fw-semibold">
                                Rp {{ number_format($laptop->total_price, 0, ',', '.') }}
                            </td>
                            <td>
                                <div class="form-check form-check-inline align-middle">
                                    <input
                                        type="checkbox"
                                        name="laptops[]"
                                        value="{{ $laptop->id }}"
                                        id="laptop_{{ $laptop->id }}"
                                        class="form-check-input"
                                        onchange="toggleQuantity({{ $laptop->id }})"
                                    />
                                    <label class="form-check-label me-3" for="laptop_{{ $laptop->id }}">Pilih</label>
                                </div>
                                <input
                                    type="number"
                                    name="quantities[{{ $laptop->id }}]"
                                    min="1"
                                    value="1"
                                    id="qty_{{ $laptop->id }}"
                                    class="form-control d-inline-block"
                                    style="width: 80px"
                                    disabled
                                />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg px-5">Buat Pesanan</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleQuantity(id) {
            const checkbox = document.getElementById('laptop_' + id);
            const qtyInput = document.getElementById('qty_' + id);
            qtyInput.disabled = !checkbox.checked;
            if (!checkbox.checked) {
                qtyInput.value = 1;
            }
        }

        // Bootstrap validation form
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');

            Array.from(forms).forEach(function (form) {
                form.addEventListener(
                    'submit',
                    function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    },
                    false
                );
            });
        })();
    </script>
</body>
</html>
