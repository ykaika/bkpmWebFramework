<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dropzone PDF Upload in Laravel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Dropzone PDF Upload in Laravel</h1>
                <form action="{{ route('pdf.store') }}" method="post" class="dropzone" id="pdf-upload">
                    @csrf
                </form>
                <button type="button" id="button" class="btn btn-primary" style="margin-top: 20px;">Upload</button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#pdf-upload", {
            maxFilesize: 1, // Maksimum ukuran file 1MB
            acceptedFiles: ".pdf",
            addRemoveLinks: true,
            autoProcessQueue: false,
            init: function() {
                var dz = this;

                // AKSI KETIKA BUTTON UPLOAD DI KLIK
                $("#button").click(function(e) {
                    e.preventDefault();
                    dz.processQueue();
                });

                this.on("sending", function(file, xhr, formData) {
                    var data = $("#pdf-upload").serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });
            }
        });
    </script>

</body>

</html>