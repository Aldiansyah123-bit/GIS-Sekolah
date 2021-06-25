<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebModel;

class WebController extends Controller
{
    public function __construct()
    {
        $this->WebModel = new WebModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pemetaan',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'sekolah' => $this->WebModel->AllDataSekolah(),
            'jenjang' => $this->WebModel->DataJenjang(),
        ];
        return view('v_web', $data);

    }

    public function kecamatan($id)
    {
        $kec = $this->WebModel->DetailData($id);
        $data = [
            'title' => 'Kecamatan '. $kec->kecamatan,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'sekolah' => $this->WebModel->DataSekolah($id),
            'jenjang' => $this->WebModel->DataJenjang(),
            'kec' => $kec,
        ];
        return view('v_kecamatan', $data);
    }

    public function jenjang($id)
    {
        $jenj = $this->WebModel->DetailJenjang($id);
        $data = [
            'title' => 'Jenjang '. $jenj->jenjang,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'sekolah' => $this->WebModel->DataSekolahJenjang($id),
            'jenjang' => $this->WebModel->DataJenjang(),
        ];
        return view('v_jenjang', $data);
    }

    public function detailsekolah($id_sekolah)
    {
        $sekolah = $this->WebModel->DetailSekolah($id_sekolah);
        $data = [
            'title' => 'Detail '. $sekolah->nama_sekolah,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'jenjang' => $this->WebModel->DataJenjang(),
            'sekolah' => $sekolah,
        ];
        return view('v_detailsekolah', $data);
    }
}
