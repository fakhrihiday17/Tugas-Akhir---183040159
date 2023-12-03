@extends('index')
@section('title', 'admin')

@section('isihalaman')

<div class="container mt-5">
    <h1>Edit Novel</h1>

    <form method="POST" action="{{ route('novel.update', ['novelId' => $novel->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="cover_image">Gambar</label>
            <input type="text" name="cover_image" class="form-control" value="{{ $novel->cover_image }}" required>
        </div>

        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $novel->title }}" required>
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" name="genre" class="form-control" value="{{ $novel->genre }}" required>
        </div>

        <div class="form-group">
            <label for="author">Penulis</label>
            <input type="text" name="author" class="form-control" value="{{ $novel->author }}" required>
        </div>

        <div class="form-group">
            <label for="sinopsis">Sinopsis</label>
            <textarea name="sinopsis" class="form-control" rows="4" required>{{ $novel->sinopsis }}</textarea>
        </div>

        <!-- Tambahkan elemen input untuk cover image jika diperlukan -->

        <button type="submit" class="btn btn-primary mb-3">Update</button>
    </form>
</div>
@endsection