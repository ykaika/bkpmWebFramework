<!DOCTYPE html>
<html>

<head>
    <title>Dropzone Image Upload in Laravel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Dropzone Image Upload in Laravel</h1>
                <form action="{{ route('dropzone.store') }}" method="post" name="file" files="true"
                    enctype="multipart/form-data" class="dropzone" id="image-upload">
                    @csrf
                    <div class="dz-message text-center">Upload Multiple Images</div>
                </form>
            </div>
        </div>
        <div class="text-center" style="margin-top: 20px;">
            <button type="button" id="button" class="btn btn-primary">Upload</button>
        </div>
    </div>

    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize: 10,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            createImageThumbnails: true,
            autoProcessQueue: false,
            init: function() {
                var myDropzone = this;

                // AKSI KETIKA BUTTON UPLOAD DI KLIK
                $("#button").click(function(e) {
                    e.preventDefault();
                    console.log("Upload button clicked!");
                    myDropzone.processQueue();
                });

                this.on("sending", function(file, xhr, formData) {
                    // Tambahkan semua input form ke formData Dropzone yang akan POST
                    var data = $("#image-upload").serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });
            }
        };
    </script>

</body>

</html>