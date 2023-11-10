@extends('indexwb')
@section('title', 'admin')

@section('isihalamanawal')

<div class="container">
    <h1 style="text-shadow: 1px 1px 4px rgba(255, 255, 255, 0.8);">Daftar Buku Favorit</h1>
    @if ($favoritedNovels->isEmpty())
    <h4 style="text-shadow: 1px 1px 4px rgba(255, 255, 255, 0.8);">Anda belum menambahkan buku ke favorit.</h4>
    @else
    <ul class="favorited-novels-list">
        @foreach ($favoritedNovels as $novel)
        <li class="favorited-novel-item">
            <img src="{{ asset('gambar/' . $novel->cover_image) }}" alt="{{ $novel->title }}" class="favorited-novel-image">
            <div class="favorited-novel-details">
                <h3 class="favorited-novel-title">{{ $novel->title }}</h3>
                <p class="favorited-novel-meta mt-1">{{ $novel->genre }} - {{ $novel->author }}</p>
                <a href="{{ route('novel.show', ['novelId' => $novel->id]) }}" class="btn btn-primary mt-1">Baca</a>
                <a href="{{ route('novel.removeFromFavorites', ['novelId' => $novel->id]) }}" class="btn btn-danger mt-1">Hapus dari Favorit</a>
            </div>
        </li>
        @endforeach
    </ul>
    @endif
</div>

</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection