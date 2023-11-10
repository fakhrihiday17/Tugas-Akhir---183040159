@extends('index')
@section('title', 'admin')

@section('isihalaman')

<!DOCTYPE html>
<html>

<head>
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
        <h1>Edit Page</h1>
        <form method="POST" action="{{ route('novel.pageUpdate', ['chapterId' => $page->chapter_id, 'pageNumber' => $page->page_number]) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="10">{{ $page->content }}</textarea>
            </div>
            <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Update Page</button>
        </form>
    </div>

</body>

</html>
@endsection