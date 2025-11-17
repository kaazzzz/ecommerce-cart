@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <!-- Add Product Button -->
    <button class="btn btn-primary mb-3" onclick="document.getElementById('addForm').style.display='block'">
        Add Product
    </button>

    <!-- Add Product Form (hidden) -->
    <div id="addForm" style="display:none;">
        <form method="POST" action="{{ route('products.store') }}" class="border p-3 mb-4">
            @csrf

            <input type="text" name="sku" placeholder="SKU" class="form-control mb-2" required>
            <input type="text" name="name" placeholder="Product Name" class="form-control mb-2" required>
            <textarea name="description" placeholder="Description" class="form-control mb-2"></textarea>
            <input type="number" name="price" step="0.01" placeholder="Price" class="form-control mb-2" required>

            <!-- Full URL allowed -->
            <input type="text" name="image_url" placeholder="Image URL (full link)" class="form-control mb-2">

            <button class="btn btn-success">Save Product</button>
        </form>
    </div>

    <table class="table">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>

        @foreach($products as $p)
            <tr>
                <!-- Show image -->
                <td>
                    @if($p->image_url)
                        <img src="{{ $p->image_url }}" alt="{{ $p->name }}" style="width:80px; height:auto;">
                    @endif
                </td>

                <td>
                    <a href="/products/{{ $p->id }}">{{ $p->name }}</a>
                </td>

                <td>{{ $p->sku }}</td>
                <td>${{ $p->price }}</td>

                <td>
                    <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('products.delete', $p->id) }}" class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete product?')">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
