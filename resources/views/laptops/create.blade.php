@extends('layouts.app')

@section('content')
<h1>Tambah Rakitan Laptop Baru</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('laptops.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nama Laptop</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <h4>Pilih Komponen:</h4>
    @foreach($components as $component)
    <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" name="components[]" value="{{ $component->id }}" id="comp{{ $component->id }}">
        <label class="form-check-label" for="comp{{ $component->id }}">
            {{ $component->name }} (Stok: {{ $component->stock }}) - Rp {{ number_format($component->unit_price, 0, ',', '.') }}
        </label>
        <input type="number" name="quantities[]" min="1" max="{{ $component->stock }}" value="1" class="form-control w-auto d-inline-block ms-3" style="vertical-align: middle;" />
    </div>
    @endforeach

    <button type="submit" class="btn btn-primary mt-3">Simpan Rakitan</button>
</form>
@endsection
