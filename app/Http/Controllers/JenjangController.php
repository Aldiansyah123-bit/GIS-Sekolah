<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenjangModel;


class JenjangController extends Controller
{
    public function __construct()
    {
        $this->JenjangModel = new JenjangModel();
    }

    public function index()
    {
    
        $data = [
            'title' => 'Jenjang',
            'jenjang' => $this->JenjangModel->AllData(),
        ];
        return view('admin/jenjang/v_index', $data);
    }

    public function add()
    {
    
        $data = [
            'title' => 'Tambah Data Jenjang',
        ];
        return view('admin/jenjang/v_add', $data);
    }

    public function insert()
    {
        Request()->validate(
            [
                'jenjang' => 'required',
                'icon' => 'required|max:1024',
            ],
            [
                'jenjang.required' => 'Jenjang Wajib Diisi !!!',
                'icon.required' => 'Icon Wajib Diisi !!!',
            ]
        );

        $file = Request()->icon;
        $filename = $file->getClientOriginalName();
        $file->move(public_path('icon'),$filename);

        $data = [
            'jenjang' => Request()->jenjang,
            'icon' => $filename,
        ];

        $this->JenjangModel->InsertData($data);

        return redirect('jenjang')->with('status', 'Data Berhasil DiSimpan!');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Jenjang',
            'jenjang' => $this->JenjangModel->DetailData($id),
        ];
        return view('admin/jenjang/v_edit', $data);
    }

    public function update($id)
    {

        Request()->validate(
            [
                'jenjang' => 'required',
            ],
            [
                'jenjang.required' => 'Jenjang Wajib Diisi !!!',
            ]
        );

       if (Request()->icon <> "") {
           //Hapus icon Lama
           $jenjang = $this->JenjangModel->DetailData($id);
           if ($jenjang->icon <> "") {
               unlink(public_path('icon'). '/' .$jenjang->icon);
           }

            //jika ingin ganti icon
            $file = Request()->icon;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('icon'),$filename);

            $data = [
                'jenjang' => Request()->jenjang,
                'icon' => $filename,
            ];
    
            $this->JenjangModel->UpdateData($id, $data);
    
            
       } else {
        
        //Jika tidak ingin mengganti icon
        $data = [
            'jenjang' => Request()->jenjang,
        ];

        $this->JenjangModel->UpdateData($id, $data);
       }
       return redirect('jenjang')->with('status', 'Data Berhasil Di Update !!!');
    }

    public function delete($id)
    {
        //Hapus icon Lama
        $jenjang = $this->JenjangModel->DetailData($id);
        if ($jenjang->icon <> "") {
            unlink(public_path('icon'). '/' .$jenjang->icon);
        }

        $this->JenjangModel->DeleteData($id);
        return redirect('jenjang')->with('status', 'Data Berhasil DiHapus !!!');
    }
}
