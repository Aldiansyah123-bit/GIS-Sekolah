<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SekolahModel;
use App\Models\JenjangModel;
use App\Models\KecamatanModel;


class SekolahController extends Controller
{
    public function __construct()
    {
        $this->SekolahModel = new SekolahModel();
        $this->JenjangModel = new JenjangModel();
        $this->KecamatanModel = new KecamatanModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Sekolah',
            'sekolah' => $this->SekolahModel->AllData(),

        ];
        return view('admin/sekolah/v_index', $data);
    }

    public function add()
    {

        $data = [
            'title' => 'Tambah Sekolah',
            'jenjang' => $this->JenjangModel->AllData(),
            'kecamatan' => $this->KecamatanModel->AllData(),
        ];
        return view('admin/sekolah/v_add', $data);
    }

    public function insert()
    {

        $this->KecamatanModel = new KecamatanModel();

        Request()->validate(
            [
                'nama_sekolah' => 'required',
                'id_jenjang' => 'required',
                'status' => 'required',
                'id_kecamatan' => 'required',
                'alamat' => 'required',
                'posisi' => 'required',
                'deskripsi' => 'required',
                'foto' => 'required|max:1024',
            ],
            [
                'nama_sekolah.required' => 'Nama Sekolah Wajib Diisi !!!',
                'id_jenjang.required' => 'Jenjang Wajib Diisi !!!',
                'status.required' => 'Status Wajib Diisi !!!',
                'id_kecamatan.required' => 'Kecamatan Wajib Diisi !!!',
                'alamat.required' => 'Alamat Sekolah Wajib Diisi !!!',
                'posisi.required' => 'Posisi Sekolah Wajib Diisi !!!',
                'deskripsi.required' => 'Deskripsi Sekolah Wajib Diisi !!!',
                'foto.required' => 'Foto Sekolah Wajib Diisi !!!',
                'foto.max' => 'Foto Sekolah Max 1024KB',
            ]
        );

        $file = Request()->foto;
        $filename = $file->getClientOriginalName();
        $file->move(public_path('foto'),$filename);

        $data = [
            'nama_sekolah' => Request()->nama_sekolah,
            'id_jenjang' => Request()->id_jenjang,
            'status' => Request()->status,
            'id_kecamatan' => Request()->id_kecamatan,
            'alamat' => Request()->alamat,
            'posisi' => Request()->posisi,
            'deskripsi' => Request()->deskripsi,
            'foto' => $filename,

        ];
        $this->SekolahModel->InsertData($data);

        return redirect('sekolah')->with('status', 'Data Berhasil DiSimpan!');
    }

    public function edit($id_sekolah)
    {

        $data = [
            'title' => 'Edit Sekolah',
            'jenjang' => $this->JenjangModel->AllData(),
            'kecamatan' => $this->KecamatanModel->AllData(),
            'sekolah' => $this->SekolahModel->DetailData($id_sekolah),
        ];
        return view('admin/sekolah/v_edit', $data);
    }

    public function update($id_sekolah)
    {
        Request()->validate(
            [
                'nama_sekolah' => 'required',
                'id_jenjang' => 'required',
                'status' => 'required',
                'id_kecamatan' => 'required',
                'alamat' => 'required',
                'posisi' => 'required',
                'deskripsi' => 'required',
                'foto' => 'max:1024',
            ],
            [
                'nama_sekolah.required' => 'Nama Sekolah Wajib Diisi !!!',
                'id_jenjang.required' => 'Jenjang Wajib Diisi !!!',
                'status.required' => 'Status Wajib Diisi !!!',
                'id_kecamatan.required' => 'Kecamatan Wajib Diisi !!!',
                'alamat.required' => 'Alamat Sekolah Wajib Diisi !!!',
                'posisi.required' => 'Posisi Sekolah Wajib Diisi !!!',
                'deskripsi.required' => 'Deskripsi Sekolah Wajib Diisi !!!',
                'foto.max' => 'Foto Sekolah Max 1024KB',
            ]
        );

        if (Request()->foto <> "") {
            //Hapus foto Lama
            $sekolah = $this->SekolahModel->DetailData($id_sekolah);
            if ($sekolah->foto <> "") {
                unlink(public_path('foto'). '/' .$sekolah->foto);
            }

             //jika ingin ganti foto
             $file = Request()->foto;
             $filename = $file->getClientOriginalName();
             $file->move(public_path('foto'),$filename);

             $data = [
                'nama_sekolah' => Request()->nama_sekolah,
                'id_jenjang' => Request()->id_jenjang,
                'status' => Request()->status,
                'id_kecamatan' => Request()->id_kecamatan,
                'alamat' => Request()->alamat,
                'posisi' => Request()->posisi,
                'deskripsi' => Request()->deskripsi,
                'foto' => $filename,

            ];
            $this->SekolahModel->UpdateData($id_sekolah,$data);


        } else {

            //Jika tidak ingin mengganti foto
            $data = [
                'nama_sekolah' => Request()->nama_sekolah,
                'id_jenjang' => Request()->id_jenjang,
                'status' => Request()->status,
                'id_kecamatan' => Request()->id_kecamatan,
                'alamat' => Request()->alamat,
                'posisi' => Request()->posisi,
                'deskripsi' => Request()->deskripsi,

            ];
            $this->SekolahModel->UpdateData($id_sekolah,$data);
        }
        return redirect('sekolah')->with('status', 'Data Berhasil Di Update !!!');
    }

    public function delete($id_sekolah)
    {
        //Hapus Foto Lama
        $sekolah = $this->SekolahModel->DetailData($id_sekolah);
        if ($sekolah->icon <> "") {
            unlink(public_path('foto'). '/' .$sekolah->foto);
        }

        $this->SekolahModel->DeleteData($id_sekolah);
        return redirect('sekolah')->with('status', 'Data Berhasil DiHapus !!!');
    }
}
