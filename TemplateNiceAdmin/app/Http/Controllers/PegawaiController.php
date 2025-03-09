<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index($nama)
    {
        return $nama;
    }

    // public function index(Request $request)
    // {
    //     return $request->segment(2);
    // }

    public function formulir()
    {
        return view('formulir');
    }

    public function proses(Request $request)
    {

        $messages = [
            'required' => 'Input :attribute wajib diisi!',
            'min' => 'Input :attribute harus diisi minimal :min karakter!',
            'max' => 'Input :attribute harus diisi maksimal :max karakter!',
            'alpha' => 'Input :attribute tidak boleh mengandung angka',
            'string' => 'Input :attribute harus berupa teks!',
        ];

        // Validasi input
        $request->validate([
            'nama' => 'required|min:5|max:30|alpha|string',
            'alamat' => 'required|min:5|string',
        ], $messages);

        //Ambil data input
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');

        return "Nama : " . $nama . ", Alamat : " . $alamat;
    }
}
