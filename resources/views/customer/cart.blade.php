@extends('layouts.customer.app')
@section('title', 'Cart')

@section('content')

    <h2>Cart Order</h2>
    @foreach ($carts as $cart)
        @if ($cart->details->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart->details as $detail)
                        <tr>
                            <td>{{ $detail->menu->name }}</td>
                            <td>
                                <form action="{{ route('cart.update', $detail->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $detail->quantity }}" min="1">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </td>
                            <td>{{ $detail->menu->price }}</td>
                            <td>{{ $detail->total_price }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $detail->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><strong>Total:</strong></td>
                        <td>{{ number_format($cart->price) }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
        @else
            <p>Your cart is empty.</p>
        @endif
    @endforeach

@endsection
