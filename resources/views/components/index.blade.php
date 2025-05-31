@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Komponen Laptop</h1>
    <div class="d-flex gap-2 align-items-center">
        <!-- Form filter jenis komponen -->
        <form method="GET" action="{{ route('components.index') }}">
            <select name="type" class="form-select d-inline w-auto" onchange="this.form.submit()">
                <option value="">-- Semua Jenis --</option>
                @foreach($types as $availableType)
                    <option value="{{ $availableType }}" {{ request('type') == $availableType ? 'selected' : '' }}>
                        {{ $availableType }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Tombol tambah -->
        <a href="{{ route('components.create') }}" class="btn btn-success">+ Tambah Komponen</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead class="table-primary">
        <tr>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Stok</th>
            <th>Harga per Unit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($components as $component)
        <tr>
            <td>{{ $component->name }}</td>
            <td>{{ $component->type }}</td>
            <td>{{ $component->stock }}</td>
            <td>Rp {{ number_format($component->unit_price, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('components.edit', $component->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('components.destroy', $component->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus komponen ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada komponen ditemukan.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@if(request('type'))
    <a href="{{ route('components.index') }}" class="btn btn-secondary btn-sm mt-2">Reset Filter</a>
@endif
@endsection
