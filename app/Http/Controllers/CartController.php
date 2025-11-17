<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // TEMP: No login, so we use user_id = 1
    private function userId()
    {
        return 1;
    }

    private function getCart()
    {
        $cart = DB::select("SELECT * FROM carts WHERE user_id = ?", [$this->userId()]);

        if (!$cart) {
            DB::insert("INSERT INTO carts (user_id) VALUES (?)", [$this->userId()]);
            $cart = DB::select("SELECT * FROM carts WHERE user_id = ?", [$this->userId()]);
        }

        return $cart[0];
    }

    // View cart
    public function index()
    {
        $cart = $this->getCart();

        $items = DB::select("
            SELECT cart_items.*, products.name
            FROM cart_items
            JOIN products ON products.id = cart_items.product_id
            WHERE cart_id = ?
        ", [$cart->id]);

        return view('cart.index', compact('cart', 'items'));
    }

    // Add item
    public function add(Request $request, $productId)
    {
        $quantity = $request->input('quantity', 1);
        $cart = $this->getCart();

        // Get product price
        $product = DB::select("SELECT * FROM products WHERE id = ?", [$productId]);
        if (!$product) abort(404);

        $product = $product[0];

        // Check if item already exists
        $item = DB::select("
            SELECT * FROM cart_items
            WHERE cart_id = ? AND product_id = ?
        ", [$cart->id, $productId]);

        if ($item) {
            DB::update("
                UPDATE cart_items
                SET quantity = quantity + ?
                WHERE id = ?
            ", [$quantity, $item[0]->id]);
        } else {
            DB::insert("
                INSERT INTO cart_items (cart_id, product_id, quantity, price)
                VALUES (?, ?, ?, ?)
            ", [$cart->id, $productId, $quantity, $product->price]);
        }

        return redirect()->route('cart.index')->with('success', 'Added to cart');
    }

    // Update quantity
    public function update(Request $request, $itemId)
    {
        $quantity = $request->quantity;

        if ($quantity == 0) {
            DB::delete("DELETE FROM cart_items WHERE id = ?", [$itemId]);
        } else {
            DB::update("
                UPDATE cart_items
                SET quantity = ?
                WHERE id = ?
            ", [$quantity, $itemId]);
        }

        return redirect()->route('cart.index');
    }

    // Remove item
    public function destroy($itemId)
    {
        DB::delete("DELETE FROM cart_items WHERE id = ?", [$itemId]);

        return redirect()->route('cart.index');
    }
}
