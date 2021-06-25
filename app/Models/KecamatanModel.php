<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KecamatanModel extends Model
{
    use HasFactory;

    public function AllData()
    {
        return DB::table('kecamatan')->get();
    }

    public function InsertData($data)
    {
        DB::table('kecamatan')->insert($data);
    }

    public function DetailData($id)
    {
        return DB::table('kecamatan')->where('id',$id)->first();
    }

    public function UpdateData($id, $data)
    {
        DB::table('kecamatan')
            ->where('id',$id)
            ->update($data);
    }
    public function DeleteData($id)
    {
        DB::table('kecamatan')
            ->where('id',$id)
            ->delete();
    }
}
