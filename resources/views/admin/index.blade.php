@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5>Pesanan</h5>
                <h3>{{ $totalOrders }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5>Laptop</h5>
                <h3>{{ $totalLaptops }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5>Komponen</h5>
                <h3>{{ $totalComponents }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5>Total Pendapatan</h5>
                <h3>Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>
<h4>Pesanan Terbaru</h4>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Merek</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recentOrders as $order)
<tr>
    <td>{{ $order->customer_name }}</td>
    <td>{{ $order->created_at->format('d M Y') }}</td>
    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
    <td>
    
            @foreach($order->laptops as $laptop)
                {{ $laptop->name }}
            @endforeach
        
    </td>
</tr>
@endforeach

    </tbody>
</table>


@endsection
