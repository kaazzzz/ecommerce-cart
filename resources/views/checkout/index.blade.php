@extends('layouts.app')

@section('content')
    <h1>Checkout</h1>

    <h3>Order Summary</h3>
    <ul>
        @foreach ($items as $i)
            <li>{{ $i->quantity }} × {{ $i->name }} — ${{ $i->quantity * $i->price }}</li>
        @endforeach
    </ul>

    <h3>Shipping Info</h3>

    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf

        <input class="form-control mb-2" name="shipping_name" placeholder="Full Name" required>
        <input class="form-control mb-2" name="shipping_address" placeholder="Address" required>
        <input class="form-control mb-2" name="shipping_city" placeholder="City" required>
        <input class="form-control mb-2" name="shipping_state" placeholder="State" required>
        <input class="form-control mb-2" name="shipping_postal_code" placeholder="Postal Code" required>

        <button class="btn btn-primary">Place Order</button>
    </form>
@endsection
