@extends('layouts.app')

@section('content')
    <h1>Order Complete!</h1>

    <p>Your order #{{ $order->id }} was placed successfully.</p>

    <h3>Items</h3>
    <ul>
        @foreach ($items as $i)
            <li>{{ $i->quantity }} × {{ $i->name }} — ${{ $i->price * $i->quantity }}</li>
        @endforeach
    </ul>

    <h3>Total: ${{ $order->total_price }}</h3>

    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Continue Shopping</a>
@endsection
