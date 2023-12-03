@extends('indexwf')
@section('title', 'admin')

@section('isihalaman')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $novel->title }} - Novel Detail</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    @if (session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif
    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('gambar/' . $novel->cover_image) }}" alt="Cover Image" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h1>{{ $novel->title }}</h1>
                <p><b>Genre:</b> {{ $novel->genre }}</p>
                <p><b>Penulis: </b>{{ $novel->author }}</p>
                <p><b>Sinopsis:</b> <br>{{ $novel->sinopsis }}</p>

                <div class="row">
                    @foreach ($chapters as $chapter)
                    <div class="col-md-6">
                        <div class="chapter">
                            <h3>{{ $chapter->title }}</h3>
                            <ul>
                                @php
                                $lastPage = $lastPages->where('chapter_id', $chapter->id)->first();
                                @endphp

                                @if ($lastPage)
                                <li>{{ $lastPage->page_number }} halaman</li>
                                @else
                                <li>No Pages Available</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="container mb-3">
                    <a href="{{ route('novel.edit', ['novelId' => $novel->id]) }}" class="btn btn-primary mb-3">Ubah Data Novel</a>
                    <div class="col-md-9">
                        <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">Kembali</a>
                        <a href="{{ route('novel.read', ['novelId' => $novel->id, 'chapterNumber' => 1, 'pageNumber' => 1])}}" class="btn btn-primary btn-lg">Baca</a>
                        @if ($novel->status_favorit == 0)
                        <a href="{{ route('novel.addToFavorites', ['novelId' => $novel->id]) }}" class="btn btn-warning btn-lg">Tambah ke Favorit</a> @endif
                        @if ($novel->status_favorit == 1)
                        <a href="{{ route('novel.removeFromFavorites', ['novelId' => $novel->id]) }}" class="btn btn-danger btn-lg">Hapus dari Favorit</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS (Optional) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

@endsection