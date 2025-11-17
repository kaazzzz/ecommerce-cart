@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf

        <label>SKU</label>
        <input type="text" name="sku" value="{{ $product->sku }}" class="form-control mb-2">

        <label>Name</label>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control mb-2">

        <label>Description</label>
        <textarea name="description" class="form-control mb-2">{{ $product->description }}</textarea>

        <label>Price</label>
        <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="form-control mb-2">

        <label>Image URL</label>
        <input type="text" name="image_url" value="{{ $product->image_url }}" class="form-control mb-2">

        <button class="btn btn-primary">Update Product</button>
    </form>

@endsection
