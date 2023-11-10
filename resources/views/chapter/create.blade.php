@extends('index')
@section('title', 'admin')

@section('isihalaman')
<!-- resources/views/novel/create.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Add Chapter</title>
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

    <h1>Tambah Bab</h1>

    <form method="post" action="{{ route('novel.chapterstore') }}">
        @csrf
        <label>Novel:</label>
        <select class="form-control" name="novel_id" class="form-select" aria-label="Default select example">
            @foreach ($novels as $novel)
            <option value="{{ $novel->id }}">{{ $novel->title }} ({{ count($novel->chapters) }} Bab)</option>
            @endforeach
        </select>

        <label>Nomor Bab: </label>
        <input class="form-control" type="number" name="chapter_number">

        <label>Judul Bab: </label>
        <input class="form-control" type="text" name="title"><br>
        <button type="submit" class="btn btn-success mb-3">Add Chapter</button>
    </form>



</body>

</html>

@endsection