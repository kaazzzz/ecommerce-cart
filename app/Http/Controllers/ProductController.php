<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = DB::select("SELECT * FROM products ORDER BY name");

        return view('products.index', compact('products'));
    }

    // Show single product
    public function show($id)
    {
        $product = DB::select("SELECT * FROM products WHERE id = ?", [$id]);

        if (!$product) {
            abort(404, "Product not found");
        }

        return view('products.show', ['product' => $product[0]]);
    }
}
