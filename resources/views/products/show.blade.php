@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>

    <!-- Show product image -->
    @if($product->image_url)
        <img src="{{ $product->image_url }}"
             alt="{{ $product->name }}"
             style="max-width:300px; height:auto; display:block; margin-bottom:20px;">
    @endif

    <p>{{ $product->description }}</p>

    <h3>${{ $product->price }}</h3>

    <form method="POST" action="{{ route('cart.add', $product->id) }}">
        @csrf
        <label>Quantity:</label>
        <input type="number" name="quantity" min="1" value="1">
        <button class="btn btn-primary mt-2">Add to Cart</button>
    </form>
@endsection
