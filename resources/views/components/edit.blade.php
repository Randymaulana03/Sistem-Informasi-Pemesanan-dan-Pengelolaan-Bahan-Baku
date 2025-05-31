@extends('layouts.app')

@section('content')
<h1>Edit Komponen</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('components.update', $component->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nama Komponen</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $component->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Jenis Komponen</label>
        <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $component->type) }}" required>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stok</label>
        <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ old('stock', $component->stock) }}" required>
    </div>

    <div class="mb-3">
        <label for="unit_price" class="form-label">Harga per Unit</label>
        <input type="number" class="form-control" id="unit_price" name="unit_price" min="0" value="{{ old('unit_price', $component->unit_price) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Komponen</button>
</form>
@endsection
