@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">Manajemen Pesanan</h2>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @if(isset($orders) && count($orders) > 0)

                        @foreach($orders as $order)

                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name ?? 'Customer' }}</td>
                            <td>Rp {{ number_format($order->total ?? 0) }}</td>
                            <td>{{ $order->status ?? 'Pending' }}</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>

                        @endforeach

                    @else

                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada pesanan
                            </td>
                        </tr>

                    @endif

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection