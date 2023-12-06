@extends('index')
@section('title', 'admin')

@section('isihalaman')

<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ubah Halaman</title>
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

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<body>

    <div class="container">
        <h1>Ubah Halaman</h1>
        <form method="POST" action="{{ route('novel.pageUpdate', ['chapterId' => $page->chapter_id, 'pageNumber' => $page->page_number]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="content">Konten</label>
                <textarea class="form-control" id="content" name="content" rows="20">{{ $page->content }}</textarea>
            </div>

            <a href="javascript:history.back()" class="btn btn-secondary mb-3">Kembali</a>
            <button type="submit" class="btn btn-primary mb-3">Ubah Halaman</button>
        </form>


    </div>

</body>
<script>
    tinymce.init({
        selector: '#content',
        height: 300,
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
        document_base_url: "{{ asset('/') }}", // Tambahkan ini

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

                success(json.location);
            };

            formData = new FormData();
            formData.append('image', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
    });
</script>

</html>
@endsection