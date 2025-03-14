<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        // Tentukan path lokasi upload
        $path = public_path('img/logo');

        // Jika folder belum ada, buat folder tersebut
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Mengambil file image dari form
        $file = $request->file('file');

        // Membuat nama file dari gabungan uniqid dan ekstensi asli
        $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Membuat canvas image dengan ukuran tertentu
        $canvas = Image::canvas(200, 200);

        // Resize image sesuai dengan mempertahankan aspek rasio
        $resizeImage = Image::make($file)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Memasukkan image yang telah di-resize ke dalam canvas
        $canvas->insert($resizeImage, 'center');

        // Simpan image ke folder
        if ($canvas->save($path . '/' . $fileName)) {
            return redirect(route('upload'))->with('success', 'Data berhasil ditambahkan!');
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
