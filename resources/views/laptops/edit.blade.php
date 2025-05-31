@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Laptop: {{ $laptop->name }}</h1>

    <form action="{{ route('laptops.update', $laptop->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Laptop</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $laptop->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('laptops.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
