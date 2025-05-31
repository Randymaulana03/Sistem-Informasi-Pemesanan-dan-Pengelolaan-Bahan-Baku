@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Rakitan Laptop</h1>
    <a href="{{ route('laptops.create') }}" class="btn btn-success">+ Tambah Rakitan Baru</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead class="table-primary">
        <tr>
            <th>Nama Laptop</th>
            <th>Total Harga</th>
            <th>Komponen</th>
            <th>Aksi</th> <!-- Kolom untuk tombol hapus -->
        </tr>
    </thead>
    <tbody>
        @foreach($laptops as $laptop)
         <tr>
        <td>{{ $laptop->name }}</td>
        <td>Rp {{ number_format($laptop->total_price, 0, ',', '.') }}</td>
        <td>
            <ul>
                @foreach($laptop->components as $component)
                    <li>{{ $component->name }} ({{ $component->pivot->quantity }})</li>
                @endforeach
            </ul>
        </td>
        <td>
            <!-- Di sini ganti dengan kode tombol Edit dan Hapus -->
            <a href="{{ route('laptops.edit', $laptop->id) }}" class="btn btn-primary btn-sm">Edit</a>

            <form action="{{ route('laptops.destroy', $laptop->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus rakitan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
    </tr>
        @endforeach
    </tbody>
</table>
@endsection
