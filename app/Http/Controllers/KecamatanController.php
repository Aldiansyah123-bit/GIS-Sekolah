<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KecamatanModel;

class KecamatanController extends Controller
{
    public function index()
    {
        $this->KecamatanModel = new KecamatanModel();
        $data = [
            'title' => 'Kecamatan',
            'kecamatan' => $this->KecamatanModel->AllData(),
        ];
        return view('admin/kecamatan/v_index', $data);
    }

    public function add()
    {        
        $data = [
            'title' => 'Tambah Kecamatan',
        ];
        return view('admin/kecamatan/v_add', $data);
    }

    public function insert()
    {

        $this->KecamatanModel = new KecamatanModel();

        Request()->validate(
            [
                'kecamatan' => 'required',
                'warna' => 'required',
                'geojs' => 'required',
            ],
            [
                'kecamatan.required' => 'Kecamatan Wajib Diisi !!!',
                'warna.required' => 'Warna Wajib Diisi !!!',
                'geojs.required' => 'Geojson Wajib Diisi !!!',
            ]
        );

        $data = [
            'kecamatan' => Request()->kecamatan,
            'warna' => Request()->warna,
            'geojs' => Request()->geojs,
            
        ];
        $this->KecamatanModel->InsertData($data);

        return redirect('kecamatan')->with('status', 'Data Berhasil DiSimpan!');
    }

    public function edit($id)
    {
        $this->KecamatanModel = new KecamatanModel();

        $data = [
            'title' => 'Edit Kecamatan',
            'kecamatan' => $this->KecamatanModel->DetailData($id),
        ];
        return view('admin/kecamatan/v_edit', $data);
    }

    public function update($id)
    {

        $this->KecamatanModel = new KecamatanModel();

        Request()->validate(
            [
                'kecamatan' => 'required',
                'warna' => 'required',
                'geojs' => 'required',
            ],
            [
                'kecamatan.required' => 'Kecamatan Wajib Diisi !!!',
                'warna.required' => 'Warna Wajib Diisi !!!',
                'geojs.required' => 'Geojson Wajib Diisi !!!',
            ]
        );

        $data = [
            'kecamatan' => Request()->kecamatan,
            'warna' => Request()->warna,
            'geojs' => Request()->geojs,
            
        ];
        $this->KecamatanModel->UpdateData($id, $data);

        return redirect('kecamatan')->with('status', 'Data Berhasil DiUpdate !!!');
    }

    public function delete($id)
    {
        $this->KecamatanModel = new KecamatanModel();

        $this->KecamatanModel->DeleteData($id);
        return redirect('kecamatan')->with('status', 'Data Berhasil DiHapus !!!');
    }
}
