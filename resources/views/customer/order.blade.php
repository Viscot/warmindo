@extends('layouts.customer.app')
@section('title', 'Order History')

@section('content')

    <div class="container mt-4">
        <h2>Order History</h2>
        @if ($carts->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td>{{ $cart->id }}</td>
                                <td>Rp {{ number_format($cart->price, 0, ',', '.') }}</td>
                                <td>{{ $cart->status }}</td>
                                <td>{{ $cart->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    @if ($cart->status == 'proses' && $cart->status != 'cancel')
                                        <form action="{{ route('order.cancel') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" name="id" value="{{ $cart->id }}" hidden>
                                            <button class="btn btn-danger" type="submit">Cancel</button>
                                        </form>
                                    @else
                                        <button class="btn btn-danger" disabled>Cancel</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center">No order history available.</p>
        @endif
    </div>

@endsection
