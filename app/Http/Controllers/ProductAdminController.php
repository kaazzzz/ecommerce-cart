<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function store(Request $request)
    {
        DB::insert("
            INSERT INTO products (sku, name, description, price, image_url, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            $request->sku,
            $request->name,
            $request->description,
            $request->price,
            $request->image_url
        ]);

        return redirect('/products')->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $product = DB::select("SELECT * FROM products WHERE id = ?", [$id]);
        if (!$product) abort(404);

        return view('products.edit', ['product' => $product[0]]);
    }

    public function update(Request $request, $id)
    {
        DB::update("
            UPDATE products
            SET sku = ?, name = ?, description = ?, price = ?, image_url = ?, updated_at = NOW()
            WHERE id = ?
        ", [
            $request->sku,
            $request->name,
            $request->description,
            $request->price,
            $request->image_url,
            $id
        ]);

        return redirect('/products/'.$id)->with('success', 'Product updated.');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM products WHERE id = ?", [$id]);

        return redirect('/products')->with('success', 'Product removed.');
    }
}
