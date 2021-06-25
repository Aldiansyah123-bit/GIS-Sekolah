<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class JenjangModel extends Model
{
    public function AllData()
    {
        return DB::table('jenjang')->get();
    }
    public function InsertData($data)
    {
        DB::table('jenjang')->insert($data);
    }

    public function DetailData($id)
    {
        return DB::table('jenjang')->where('id',$id)->first();
    }

    public function UpdateData($id, $data)
    {
        DB::table('jenjang')
            ->where('id',$id)
            ->update($data);
    }

    public function DeleteData($id)
    {
        DB::table('jenjang')
            ->where('id',$id)
            ->delete();
    }
}
