<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class UploadController extends Controller
{
    public function upload()
    {
        return view('upload.upload');
    }

    public function proses_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'keterangan' => 'required',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // nama file
        echo 'File Name: ' . $file->getClientOriginalName() . '<br>';

        // ekstensi file
        echo 'File Extension: ' . $file->getClientOriginalExtension() . '<br>';

        // real path
        echo 'File Real Path: ' . $file->getRealPath() . '<br>';

        // ukuran file
        echo 'File Size: ' . $file->getSize() . '<br>';

        // tipe mime
        echo 'File Mime Type: ' . $file->getMimeType() . '<br>';

        // Dapatkan nama file asli
        $nama_file = $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'uploads';

        // upload file
        $file->move(public_path($tujuan_upload), $nama_file);
    }

    public function resize_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'keterangan' => 'required',
        ]);

        // Tentukan path lokasi upload
        $path = public_path('img/logo');

        // Jika folder belum ada, buat foldernya
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Ambil file dari form
        $file = $request->file('file');

        // Buat nama file baru dengan uniqid
        $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Gunakan ImageManager dengan GD Driver
        $manager = new ImageManager(new Driver());

        // Baca file
        $image = $manager->read($file->getPathname());

        // Resize image sesuai tinggi 200px dengan mempertahankan aspect ratio
        $image->scale(height: 200);

        // Buat canvas ukuran 200x200
        $canvas = $manager->create(200, 200);

        // Masukkan gambar yang telah di-resize ke dalam canvas (posisi tengah)
        $canvas->place($image, 'center');

        // Simpan image ke folder
        $canvas->save($path . '/' . $fileName);

        // Simpan image ke folder dan cek apakah berhasil
        if ($canvas->save($path . '/' . $fileName)) {
            return redirect(route('upload'))->with('success', 'Data berhasil ditambahkan (resize)!');
        } else {
            return redirect(route('upload'))->with('error', 'Data gagal ditambahkan!');
        }
    }

    public function dropzone()
    {
        return view('upload.dropzone');
    }

    public function dropzone_store(Request $request)
    {
        $image = $request->file('file');

        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('img/dropzone'), $imageName);

        return response()->json(['success' => $imageName]);
    }

    public function pdf_upload()
    {
        return view('upload.pdf_upload');
    }

    public function pdf_store(Request $request)
    {
        $pdf = $request->file('file');

        $pdfName = 'pdf_' . time() . '.' . $pdf->extension();
        $pdf->move(public_path('pdf/dropzone'), $pdfName);

        return response()->json(['success' => $pdfName]);
    }
}
