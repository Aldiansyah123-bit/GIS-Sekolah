<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
    
        $data = [
            'title' => 'User',
        ];
        $user = User::all();
        return view('admin/user/v_index',compact('user'), $data);
    }

    public function add()
    {
    
        $data = [
            'title' => 'User Tambah',
        ];
        $user = User::all();
        return view('admin/user/v_add',compact('user'), $data);
    }

    public function insert(Request $request)
    {
        Request()->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:8',
                'foto' => 'required|max:1024',
            ],
            [
                'name.required' => 'Nama Wajib Diisi !!!',
                'email.required' => 'E-Mail Wajib Diisi !!!',
                'password.required' => 'Password Wajib Diisi !!!',
                'password.min' => 'Password Minimal 8 Angka',
                'foto.required' => 'Foto Wajib Diisi !!!',
                'foto.max' => 'Foto Max 1024 KB',
            ]
        );

        $file = Request()->foto;
        $filename = $file->getClientOriginalName();
        $file->move(public_path('/storage/profile-photos'),$filename);

        $peg = new User;    
        $peg->name = $request->input('name');
        $peg->email = $request->input('email');
        $peg->password = Hash::make($request->password);
        $peg->profile_photo_path = $filename;
        $peg->save();


        return redirect('user')->with('status', 'Data Berhasil DiSimpan!');
    }

    public function edit($id)
    {
    
        $data = [
            'title' => 'User Edit',
        ];
        $user = User::where('id', $id)->first();
        return view('admin/user/v_edit',compact('user'), $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Nama Wajib Diisi !!!',
            ]
        );
        if (Request()->foto <> "") {
            //Hapus Foto Lama
            $user = User::findOrFail($id);
            if ($user->profile_photo_path <> "") {
                unlink(public_path('/storage/profile-photos'). '/' .$user->profile_photo_path);
            }
 
             //jika ingin ganti Foto
             $file = Request()->foto;
             $filename = $file->getClientOriginalName();
             $file->move(public_path('/storage/profile-photos'),$filename);
 
            User::where('id', $id)
            ->update([
                'name' => $request->name, 
                'profile_photo_path' => $filename,
            ]);
     
             
        } else {
         
         //Jika tidak ingin mengganti Foto
         User::where('id', $id)
         ->update([
             'name' => $request->name, 
         ]);
        }
         return redirect('user')->with('status', 'Data Berhasil DiUpdate!');
    }

    function delete($id)
    {
        //Hapus Foto Lama
        $user = User::findOrFail($id);    
        if ($user->	profile_photo_path <> "") {
            unlink(public_path('/storage/profile-photos'). '/' .$user->	profile_photo_path);
        }
        User::where(['id'=>$id])->delete();
        return redirect()->back()->with('status', 'Data Berhasil DiHapus!');
    }

}
