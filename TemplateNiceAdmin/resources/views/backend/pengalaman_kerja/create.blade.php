@extends('layouts.layout')

@section('content')

<div class="pagetitle mb-4">
    <h1>Tambah Pengalaman Kerja</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pengalaman_kerja.index') }}">Riwayat Hidup</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pengalaman_kerja.index') }}">Pengalaman Kerja</a></li>
            <li class="breadcrumb-item active">Tambah Pengalaman Kerja</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="wrapper">
    <div class="panel panel-default mb-4">
        <div class="panel-heading fw-semibold fs-5 mb-3 text-center">Form Tambah Pengalaman Kerja</div> 
            @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ isset($pengalaman_kerja) ? route('pengalaman_kerja.update', $pengalaman_kerja->id) : route('pengalaman_kerja.store') }}" method="POST">
                @csrf
                @if(isset($pengalaman_kerja))
                @method('PUT')
                <input type="hidden" name="id" value="{{ $pengalaman_kerja->id }}">
                @endif

                <div class="form-group mb-3">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="name" class="form-control" value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->name : '' }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->jabatan : '' }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Tahun Masuk</label>
                    <input type="number" name="tahun_masuk" class="form-control" value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->tahun_masuk : '' }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Tahun Keluar</label>
                    <input type="number" name="tahun_keluar" class="form-control" value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->tahun_keluar : '' }}">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">{{ isset($pengalaman_kerja) ? 'Update' : 'Save' }}</button>
                    <a href="{{ route('pengalaman_kerja.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection