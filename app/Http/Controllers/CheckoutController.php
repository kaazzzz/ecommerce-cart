<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private function userId()
    {
        return 1;
    }

    private function getCart()
    {
        $cart = DB::select("SELECT * FROM carts WHERE user_id = ?", [$this->userId()]);
        return $cart ? $cart[0] : null;
    }

    public function index()
    {
        $cart = $this->getCart();

        if (!$cart) return redirect()->route('cart.index');

        $items = DB::select("
            SELECT cart_items.*, products.name
            FROM cart_items
            JOIN products ON products.id = cart_items.product_id
            WHERE cart_id = ?
        ", [$cart->id]);

        return view('checkout.index', compact('cart', 'items'));
    }

    public function store(Request $request)
    {
        $cart = $this->getCart();

        $items = DB::select("SELECT * FROM cart_items WHERE cart_id = ?", [$cart->id]);

        if (!$items) {
            return redirect()->route('cart.index')->with('error', 'Cart empty');
        }

        $total = 0;
        foreach ($items as $i) {
            $total += ($i->quantity * $i->price);
        }

        // Insert order
        DB::insert("
            INSERT INTO orders (user_id, total_price, shipping_name, shipping_address, shipping_city, shipping_state, shipping_zip)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ", [
            $this->userId(), $total,
            $request->shipping_name,
            $request->shipping_address,
            $request->shipping_city,
            $request->shipping_state,
            $request->shipping_postal_zip
        ]);

        // Retrieve new order ID
        $order = DB::select("SELECT * FROM orders ORDER BY id DESC LIMIT 1")[0];

        // Insert order items
        foreach ($items as $i) {
            DB::insert("
                INSERT INTO order_items (order_id, product_id, quantity, price)
                VALUES (?, ?, ?, ?)
            ", [
                $order->id,
                $i->product_id,
                $i->quantity,
                $i->price
            ]);
        }

        // Clear cart
        DB::delete("DELETE FROM cart_items WHERE cart_id = ?", [$cart->id]);

        return redirect()->route('checkout.success', $order->id);
    }

    public function success($orderId)
    {
        $order = DB::select("SELECT * FROM orders WHERE id = ?", [$orderId])[0];

        $items = DB::select("
            SELECT order_items.*, products.name
            FROM order_items
            JOIN products ON products.id = order_items.product_id
            WHERE order_id = ?
        ", [$orderId]);

        return view('checkout.success', compact('order', 'items'));
    }
}
