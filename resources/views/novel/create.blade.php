@extends('index')
@section('title', 'admin')

@section('isihalaman')
<!-- resources/views/novel/create.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Add Novel</title>
</head>

<body>
    <h1>Tambah Data Novel</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('novel.store') }}" method="POST">
        @csrf
        <label for="cover_image" class="col-sm-4 col-form-label">Gambar:</label>
        <input type="text" class="form-control" id="cover_image" name="cover_image" required>

        <label for="title" class="col-sm-4 col-form-label">Judul Novel:</label>
        <input type="text" class="form-control" id="title" name="title" required>

        <label for="genre" class="col-sm-4 col-form-label">Genre:</label>
        <input type="text" class="form-control" id="genre" name="genre" required>

        <label for="author" class="col-sm-4 col-form-label">Penulis:</label>
        <input type="text" class="form-control" id="author" name="author" required>
        <div class="form-floating">
            <label>Sinopsis:</label>
            <textarea id="sinopsis" name="sinopsis" rows="5" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3 mb-3">Tambah Novel</button>
    </form>
</body>

</html>

@endsection