<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Order
{
    public static function create($userId, $total, $data)
    {
        DB::insert("
            INSERT INTO orders (user_id, total_amount, shipping_name, shipping_address, shipping_city, shipping_state, shipping_postal_code)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ", [
            $userId,
            $total,
            $data['shipping_name'],
            $data['shipping_address'],
            $data['shipping_city'],
            $data['shipping_state'],
            $data['shipping_postal_code'],
        ]);

        return DB::select("SELECT * FROM orders ORDER BY id DESC LIMIT 1")[0];
    }

    public static function find($id)
    {
        $res = DB::select("SELECT * FROM orders WHERE id = ?", [$id]);
        return $res ? $res[0] : null;
    }

    public static function items($orderId)
    {
        return DB::select("
            SELECT order_items.*, products.name
            FROM order_items
            JOIN products ON products.id = order_items.product_id
            WHERE order_id = ?
        ", [$orderId]);
    }
}
