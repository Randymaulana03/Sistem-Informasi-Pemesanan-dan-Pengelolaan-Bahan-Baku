<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ranss Store Computer</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-image: url('adha-shopping-basket-laptops-left-side.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
  
  .card {
    background-color: rgba(255, 255, 255, 0.95);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    border-radius: 12px;
  }

  h1.text-white {
    text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
  }

  .navbar {
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  }

  </style>
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">Ranss Store Computer</a>
      <div class="ms-auto d-flex align-items-center">
        <span class="me-3 text-dark">
          👤 {{ Auth::user()->name ?? Auth::user()->email }}
        </span>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-secondary btn-sm">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container py-5">
   <h1 class="mb-4 text-center text-white" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.7);">
    Dashboard User
  </h1>


    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow-sm border-0">
      <div class="card-header bg-dark text-white">
        <h5 class="mb-0">List Laptop Siap Order</h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <thead class="table-secondary">
            <tr>
              <th>Nama</th>
              <th>Harga</th>
              <th>Spesifikasi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($laptops as $laptop)
            <tr>
              <td class="text-dark fw-medium">{{ $laptop->name }}</td>
              <td class="text-dark fw-medium">Rp {{ number_format($laptop->total_price, 0, ',', '.') }}</td>
              <td>
                <ul class="mb-0 ps-3">
                  @foreach($laptop->components as $component)
                    <li>{{ $component->name }} ({{ $component->pivot->quantity }})</li>
                  @endforeach
                </ul>
              </td>
              <td class="text-dark fw-medium">
                <a href="{{ route('orders.create', $laptop->id) }}" class="btn btn-sm btn-success">Order Sekarang</a>
            </td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
