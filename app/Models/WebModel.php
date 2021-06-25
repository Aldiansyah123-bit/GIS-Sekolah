<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WebModel extends Model
{
    public function DataKecamatan()
    {
        return DB::table('kecamatan')->get();
    }

    public function DataJenjang()
    {
        return DB::table('jenjang')->get();
    }

    public function DataSekolahJenjang($id)
    {
        return DB::table('sekolah')
            ->join('jenjang', 'jenjang.id', '=', 'sekolah.id_jenjang')
            ->join('kecamatan', 'kecamatan.id', '=', 'sekolah.id_kecamatan')
            ->where('sekolah.id_jenjang', $id)
            ->get();
    }

    public function DetailJenjang($id)
    {
        return DB::table('jenjang')->where('id',$id)->first();
    }


    public function DetailData($id)
    {
        return DB::table('kecamatan')->where('id',$id)->first();
    }


    public function DataSekolah($id)
    {
        return DB::table('sekolah')
            ->join('jenjang', 'jenjang.id', '=', 'sekolah.id_jenjang')
            ->join('kecamatan', 'kecamatan.id', '=', 'sekolah.id_kecamatan')
            ->where('sekolah.id_kecamatan', $id)
            ->get();
    }

    public function AllDataSekolah()
    {
        return DB::table('sekolah')
            ->join('jenjang', 'jenjang.id', '=', 'sekolah.id_jenjang')
            ->join('kecamatan', 'kecamatan.id', '=', 'sekolah.id_kecamatan')
            ->get();
    }

    public function DetailSekolah($id_sekolah)
    {
        return DB::table('sekolah')
            ->join('jenjang', 'jenjang.id', '=', 'sekolah.id_jenjang')
            ->join('kecamatan', 'kecamatan.id', '=', 'sekolah.id_kecamatan')
            ->where('sekolah.id_sekolah', $id_sekolah)
            ->first();
    }

}
