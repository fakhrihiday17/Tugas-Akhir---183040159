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
    <div class="container mt-5">
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

                <div class="mt-1 mb-2">

                    <div class="container">
                        <h3>Ubah Data Novel, Judul Bab, dan, Halaman</h3>
                        <div class="row">
                            <a href="{{ route('novel.edit', ['novelId' => $novel->id]) }}">
                                <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="">
                                    Ubah Data Novel
                                </button>
                            </a>
                            @foreach ($chapters as $chapter)
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Chapter {{ $chapter->chapter_number }}: {{ $chapter->title }}</h5>
                                        <a href="{{ route('novel.chapterEdit', ['novelId' => $chapter->novel_id, 'chapterNumber' => $chapter->chapter_number]) }}" class="btn btn-primary btn-sm mb-2">Ubah Judul Bab</a>

                                        <!-- Tombol Edit Page -->
                                        @foreach ($chapter->pages as $page)
                                        <a href="{{ route('novel.pageEdit', ['chapterId' => $page->chapter_id, 'pageNumber' => $page->page_number]) }}" class="btn btn-primary btn-sm mb-2">Ubah Halaman {{ $page->page_number }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="container">
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