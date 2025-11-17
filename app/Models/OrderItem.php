<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class OrderItem
{
    public static function create($orderId, $productId, $quantity, $price)
    {
        DB::insert("
            INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES (?, ?, ?, ?)
        ", [
            $orderId,
            $productId,
            $quantity,
            $price
        ]);
    }
}
