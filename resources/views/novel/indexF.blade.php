@extends('indexwb')
@section('title', 'admin')

@section('isihalamanawal')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div id="book-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach($novels as $novel)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <div class="container d-flex align-items-center flex-column">
                <a href="{{ route('novel.show', ['novelId' => $novel->id]) }}" style="text-decoration: none;">
                    <h5 class="title mt-3 text-center">{{ $novel->title }}</h5>
                    <img src="{{ asset('gambar/' . $novel->cover_image) }}" class="img-square" alt="{{ $novel->title }}">
                </a>
                <p>{{ $novel->sinopsis }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#book-carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#book-carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container">
    <div class="novel-list mx-auto p-2">
        <div class="row">
            @foreach($novels as $novel)
            <div class="col-md-3">
                <div class="card mb-3 kartu">
                    <img src="{{ asset('gambar/' . $novel->cover_image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $novel->title }}</h5>
                        <p class="card-text">Oleh: {{ $novel->author }}</p>
                        <a href="{{ route('novel.show', ['novelId' => $novel->id]) }}" class="btn btn-primary">Baca</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection