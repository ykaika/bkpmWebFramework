<html>

<head>
    <title>Upload File Dengan Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="row">
        <div class="container">
            <h2 class="text-center my-5">Upload File Dengan Laravel</h2>
            <div class="col-lg-8 mx-auto my-5">

                {{-- Pesan Jika Success --}}
                @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close text-decoration-none" 
                    data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
                @endif

                {{-- Peringatan Jika Error --}}
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close text-decoration-none" 
                    data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('error') }}
                </div>
                @endif

                {{-- Validasi Jika Ada Error --}}
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }} <br />
                    @endforeach
                </div>
                @endif

                {{-- Form upload file --}}
                <form action="{{ route('upload.resize') }}" method="POST" enctype="multipart/form-data">
                    @csrf {{-- Laravel CSRF Protection --}}

                    <div class="form-group">
                        <b>File Gambar</b><br />
                        <input type="file" name="file">
                    </div>

                    <div class="form-group">
                        <b>Keterangan</b>
                        <textarea class="form-control" name="keterangan"></textarea>
                    </div>

                    <input type="submit" value="Upload" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>

</html>