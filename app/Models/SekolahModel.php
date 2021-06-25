<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SekolahModel extends Model
{
    public function AllData()
    {
        return DB::table('sekolah')
            ->join('jenjang', 'jenjang.id', '=', 'sekolah.id_jenjang')
            ->join('kecamatan', 'kecamatan.id', '=', 'sekolah.id_kecamatan')
            ->get();
    }

    public function InsertData($data)
    {
        DB::table('sekolah')->insert($data);
    }

    public function DetailData($id_sekolah)
    {
        return DB::table('sekolah')
            ->join('jenjang', 'jenjang.id', '=', 'sekolah.id_jenjang')
            ->join('kecamatan', 'kecamatan.id', '=', 'sekolah.id_kecamatan')
            ->where('id_sekolah',$id_sekolah)->first();
    }

    public function UpdateData($id_sekolah, $data)
    {
        DB::table('sekolah')
            ->where('id_sekolah',$id_sekolah)
            ->update($data);
    }
    public function DeleteData($id_sekolah)
    {
        DB::table('sekolah')
            ->where('id_sekolah',$id_sekolah)
            ->delete();
    }

    // protected $fillable = [
    //     'nama_sekolah', 
    //     'id_jenjang', 
    //     'status',
    //     'id_kecamatan',
    //     'alamat',
    //     'posisi',
    //     'deskripsi',
    //     'foto',
    // ];

    // public function jenjang()
    // {
    //     return $this->belongsTo('App\Models\JenjangModel');
    // }
    // public function kecamatan()
    // {
    //     return $this->belongsTo('App\Models\KecamatanModel');
    // }
}
