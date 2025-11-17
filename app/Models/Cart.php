<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Cart
{
    public static function findOrCreateByUser($userId)
    {
        $cart = DB::select("SELECT * FROM carts WHERE user_id = ?", [$userId]);

        if (!$cart) {
            DB::insert("INSERT INTO carts (user_id) VALUES (?)", [$userId]);
            $cart = DB::select("SELECT * FROM carts WHERE user_id = ?", [$userId]);
        }

        return $cart[0];
    }

    public static function items($cartId)
    {
        return DB::select("
            SELECT cart_items.*, products.name
            FROM cart_items
            JOIN products ON products.id = cart_items.product_id
            WHERE cart_id = ?
        ", [$cartId]);
    }
}
