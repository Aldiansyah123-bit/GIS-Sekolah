<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'kecamatan' => DB::table('kecamatan')->count(),
            'jenjang' => DB::table('jenjang')->count(),
            'sekolah' => DB::table('sekolah')->count(),
            'user' => DB::table('users')->count(),
        ];
        return view('dashboard', $data);
    }
}
