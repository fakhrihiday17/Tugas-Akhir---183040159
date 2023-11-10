@extends('index')
@section('title', 'admin')

@section('isihalaman')
<!-- resources/views/chapter/create.blade.php -->
<!DOCTYPE html>
<html>

<head>
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
    <form method="post" action="{{ route('novel.pagestore') }}">
        @csrf
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
            <label>Konten:</label>
            <textarea name="content" rows="5" class="form-control"></textarea><br>
            <button type="submit" class="btn btn-success">Tambah Halaman</button>
        </div>
    </form>


</body>

</html>

@endsection