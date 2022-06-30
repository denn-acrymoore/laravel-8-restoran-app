<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShoppingModel extends Model
{
    public function allData()
    {
        return DB::table('tbl_shopping')->get();
    }

    public function detailData($shopping_cart_id)
    {
        return DB::table('tbl_shopping')->where('shopping_cart_id', $shopping_cart_id)->first();
    }

    public function getBiggestID()
    {
        return DB::table('tbl_shopping')
        ->select('shopping_cart_id')
        ->orderBy('shopping_cart_id', 'desc')
        ->first();
    }

    public function addData($data)
    {
        return DB::table('tbl_shopping')->insert($data);
    }

    public function editData($shopping_cart_id, $data)
    {
        return DB::table('tbl_shopping')
        ->where('shopping_cart_id', $shopping_cart_id)
        ->update($data);
    }

    public function deleteData($shopping_cart_id)
    {
        return DB::table('tbl_shopping')
        ->where('shopping_cart_id', $shopping_cart_id)
        ->delete();
    }
}
