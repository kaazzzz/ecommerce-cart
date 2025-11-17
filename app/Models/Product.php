<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Product
{
    public static function all()
    {
        return DB::select("SELECT * FROM products ORDER BY name");
    }

    public static function find($id)
    {
        $result = DB::select("SELECT * FROM products WHERE id = ?", [$id]);
        return $result ? $result[0] : null;
    }
}
