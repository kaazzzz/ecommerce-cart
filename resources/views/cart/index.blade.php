@extends('layouts.app')

@section('content')
    <h1>Your Cart</h1>

    @if (count($items) === 0)
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th></th>
            </tr>

            <a href="{{ route('products.index') }}" class="btn btn-primary mb-3">
                ← Add More Products
            </a>

            @foreach ($items as $i)
                <tr>
                    <td>{{ $i->name }}</td>
                    <td>
                        <form method="POST" action="{{ route('cart.update', $i->id) }}">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $i->quantity }}" min="0">
                            <button class="btn btn-sm btn-secondary">Update</button>
                        </form>
                    </td>
                    <td>${{ $i->price }}</td>
                    <td>${{ $i->price * $i->quantity }}</td>
                    <td>
                        <form method="POST" action="{{ route('cart.destroy', $i->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <a href="{{ route('checkout.index') }}" class="btn btn-success">Proceed to Checkout</a>
    @endif
@endsection
