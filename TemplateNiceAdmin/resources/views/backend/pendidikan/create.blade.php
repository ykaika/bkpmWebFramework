@extends('layouts.layout')

@section('content')

<div class="pagetitle mb-4">
    <h1>Tambah Pendidikan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pendidikan.index') }}">Riwayat Hidup</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pendidikan.index') }}">Pendidikan</a></li>
            <li class="breadcrumb-item active">Tambah Pendidikan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="wrapper">
    <div class="panel panel-default mb-4">
        <div class="panel-heading fw-semibold fs-5 mb-3 text-center">Form Tambah Pendidikan</div>
        <div class="panel-body">
            @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('pendidikan.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label>Nama Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Tingkatan <span class="text-danger">*</span></label>
                    <select class="form-control" name="tingkatan" required>
                        <option value="1">TK/PAUD</option>
                        <option value="2">SD</option>
                        <option value="3">SMP</option>
                        <option value="4">SMA</option>
                        <option value="5">D3</option>
                        <option value="6">S1</option>
                        <option value="7">S2</option>
                        <option value="8">S3</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Tahun Masuk <span class="text-danger">*</span></label>
                    <input type="number" name="tahun_masuk" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Tahun Selesai <span class="text-danger">*</span></label>
                    <input type="number" name="tahun_keluar" class="form-control" required>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('pendidikan.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection