@extends('index')
@section('title', 'admin')

@section('isihalaman')

<!DOCTYPE html>
<html>

<head>
    <title>Ubah Bab</title>
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

    <h1>Ubah Bab</h1>

    <form method="POST" action="{{ route('novel.chapterUpdate', ['novelId' => $chapter->novel_id, 'chapterNumber' => $chapter->chapter_number]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $chapter->title }}" required>
        </div>
        <a href="javascript:history.back()" class="btn btn-secondary mb-3">Back</a>
        <button type="submit" class="btn btn-primary mb-3">Ubah Bab</button>
    </form>


</body>

</html>
@endsection