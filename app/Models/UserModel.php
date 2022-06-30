<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    public function allData()
    {
       return DB::table('users')->get();
    }   

    public function detailData($user_id)
    {
        return DB::table('users')->where('user_id', $user_id)->first();
    }

    public function getBiggestID()
    {
        return DB::table('users')
        ->select('user_id')
        ->orderBy('user_id', 'desc')
        ->first();
    }

    public function addData($data)
    {
        return DB::table('users')->insert($data);
    }

    public function editData($user_id, $data)
    {
        return DB::table('users')
        ->where('user_id', $user_id)
        ->update($data);
    }

    public function checkVerySpecificData($data)
    {
        return DB::table('users')
        ->where('first_name', $data['first_name'])
        ->where('last_name', $data['last_name'])
        ->where('username', $data['username'])
        ->where('password', $data['password'])
        ->where('salt', $data['salt'])
        ->where('birth_date', $data['birth_date'])
        ->where('sex', $data['sex'])
        ->where('type', $data['type'])
        ->first();
    }

    public function deleteData($user_id)
    {
        return DB::table('users')
        ->where('user_id', $user_id)
        ->delete();
    }

    public function getByUsername($username)
    {
        return DB::table('users')->where('username', $username)->first();
    }
}
