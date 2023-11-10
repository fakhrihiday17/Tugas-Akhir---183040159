@extends('index')
@section('title', 'admin')

@section('isihalaman')

<!-- resources/views/novel/index.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Novel List</title>
</head>

<body style="background-image: url(/gambar/bg.svg);">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1>Novel List</h1>
    <a href="/novel/create">
        <button type="button" class="btn btn-primary">
            Tambah Data Novel
        </button></a>
    <a href="/novel/chaptercreate">
        <button type="button" class="btn btn-secondary">
            Tambah Data Bab
        </button></a>
    <a href="/novel/pagecreate">
        <button type="button" class="btn btn-success">
            Tambah Data Halaman
        </button></a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped mb-5">
            <thead>
                <tr>
                    <td align="center">ID</td>
                    <td align="center">Gambar</td>
                    <td align="center">Judul</td>
                    <td align="center">Genre</td>
                    <td align="center">Penulis</td>
                    <td align="center">Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach($novels as $novel)
                <tr>
                    <td align="center" scope="row">{{ $novel->id }}</td>
                    <td><img src="{{ asset('gambar/' . $novel->cover_image) }}" alt="Cover Image" class="img-awal"></td>
                    <td>{{ $novel->title }}</td>
                    <td>{{ $novel->genre }}</td>
                    <td>{{ $novel->author }}</td>

                    <td>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('novel.show', ['novelId' => $novel->id]) }}" class="btn btn-info mr-2" style="text-decoration: none;">
                                Detail
                            </a>
                            <form method="POST" action="{{ route('novel.destroy', ['novelId' => $novel->id]) }}" onsubmit="return confirm('Are you sure you want to delete this novel and all its chapters and pages?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus Novel</button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>


@endsection