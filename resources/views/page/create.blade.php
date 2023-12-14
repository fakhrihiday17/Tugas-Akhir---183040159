@extends('index')
@section('title', 'admin')

@section('isihalaman')
<!DOCTYPE html>
<html>

<head>
    <script src="path/to/tinymce/tinymce.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Data Halaman</title>
</head>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<body>
    <h1>Tambah Data Halaman</h1>
    <form method="post" action="{{ route('novel.pagestore') }}" enctype="multipart/form-data">
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <label>Judul Novel: </label>
        <select class="form-control" name="chapter_id">
            @foreach ($novels as $novel)
            <optgroup label="{{ $novel->title }}">
                @foreach ($novel->chapters as $chapter)
                <option value="{{ $chapter->id }}">{{ $chapter->title }} ({{ count($chapter->pages) }} Halaman)</option>
                @endforeach
            </optgroup>
            @endforeach
        </select>
        <br>
        <label>Nomor Halaman: </label>
        <input class="form-control" type="number" name="page_number"><br>

        <div class="form-floating">
            <label for="content">Konten:</label>
            <textarea id="content" name="content" rows="5" class="form-control"></textarea><br>
        </div>

        <button type="submit" class="btn btn-success mb-3">Tambah Halaman</button>
    </form>


    <div class="modal fade" id="imageUploadModal" tabindex="-1" role="dialog" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageUploadModalLabel">Upload Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulir pengunggahan gambar -->
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Pilih Gambar:</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="uploadImage()">Upload</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    tinymce.init({
        selector: '#content',
        height: 500,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help | image',
        images_upload_url: '/upload-image',
        images_upload_base_path: '/gambar/', // URL dasar gambar
        images_upload_credentials: false, // Matikan penggunaan kredensial
        document_base_url: "{{ url('/') }}", // URL dasar dokumen

        images_upload_handler: function(blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/upload-image');
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

            xhr.onload = function() {
                var json;

                if (xhr.status !== 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location !== 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                // Hapus awalan / dari URL gambar agar menjadi relatif
                var relativeUrl = json.location.replace(/^\//, '');

                success(relativeUrl);
            };

            formData = new FormData();
            formData.append('image', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
    });
</script>


</html>
@endsection