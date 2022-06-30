<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    public function allData()
    {
        return DB::table('tbl_product')->get(); 
    }

    public function detailData($product_id)
    {
        return DB::table('tbl_product')->where('product_id', $product_id)->first();
    }

    public function getBiggestID()
    {
        return DB::table('tbl_product')
        ->select('product_id')
        ->orderBy('product_id', 'desc')
        ->first();
    }

    public function addData($data)
    {
        return DB::table('tbl_product')->insert($data);
    }

    public function editData($product_id, $data)
    {
        return DB::table('tbl_product')
        ->where('product_id', $product_id)
        ->update($data);
    }

    public function checkVerySpecificData($data)
    {
        return DB::table('tbl_product')
        ->where('name', $data['name'])
        ->where('price', $data['price'])
        ->where('description', $data['description'])
        ->where('category', $data['category'])
        ->where('picture', $data['picture'])
        ->first();
    }

    public function deleteData($product_id)
    {
        return DB::table('tbl_product')
        ->where('product_id', $product_id)
        ->delete();
    }
}
