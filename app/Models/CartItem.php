<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class CartItem
{
    public static function findItem($cartId, $productId)
    {
        $items = DB::select("
            SELECT * FROM cart_items
            WHERE cart_id = ? AND product_id = ?
        ", [$cartId, $productId]);

        return $items ? $items[0] : null;
    }

    public static function create($cartId, $productId, $quantity, $price)
    {
        DB::insert("
            INSERT INTO cart_items (cart_id, product_id, quantity, price)
            VALUES (?, ?, ?, ?)
        ", [$cartId, $productId, $quantity, $price]);
    }

    public static function updateQty($itemId, $quantity)
    {
        DB::update("
            UPDATE cart_items
            SET quantity = ?
            WHERE id = ?
        ", [$quantity, $itemId]);
    }

    public static function delete($itemId)
    {
        DB::delete("DELETE FROM cart_items WHERE id = ?", [$itemId]);
    }
}
