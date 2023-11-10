<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Buku Novel</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5/10/0/css/all.css">
    <script type="text/javascript" src="{{ asset('assets') }}/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body style="background-image: url(/gambar/bg.svg);">
    <div class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/" class="nav-link">Home</a>
            </li>

            <li class="nav-item">
                <a href="/novel" class="nav-link">Data Buku</a>
            </li>

            <li class="nav-item">
                <a href="/user" class="nav-link">Data User</a>
            </li>

            <li class="nav-item">
                <a href="/admin" class="nav-link">Data Admin</a>
            </li>

            <li class="nav-item">
                <a href="/logout" class="nav-link">Logout</a>
            </li>
        </ul>
    </div>
    <div class="container mt-5 bg-light">
        <h1>{{ $novel->title }}</h1>
        <h2>Chapter {{ $chapter->chapter_number }}</h2>

        <div class="d-flex justify-content-center align-items-center" style="min-height: 400px;">
            <div id="bookmarked-content" contentEditable="true" class="mb-2">
                {{ $page->content }}
            </div>
        </div>
        <button id="bookmark-button" class="btn btn-warning" style="display: none;">Bookmark</button>
        <button id="remove-bookmarks" class="btn btn-danger">Hapus Bookmark</button>

        <div class="pagination mt-3">
            <div class="row">
                <div class="col-md-6 text-md-end">
                    @if ($previousPage)
                    <a href="{{ route('novel.read', ['novelId' => $novel->id, 'chapterNumber' => $chapter->chapter_number, 'pageNumber' => $previousPage->page_number]) }}" class="btn btn-primary mb-2">Previous Page</a>
                    @elseif ($previousChapter && $lastPageOfPreviousChapter)
                    <a href="{{ route('novel.read', ['novelId' => $novel->id, 'chapterNumber' => $previousChapter->chapter_number, 'pageNumber' => $lastPageOfPreviousChapter->page_number]) }}" class="btn btn-primary">Previous Chapter</a>
                    @endif
                </div>
                <div class="col-md-6 text-md-end">
                    @if (!$isLastPage)
                    <a href="{{ route('novel.read', ['novelId' => $novel->id, 'chapterNumber' => $chapter->chapter_number, 'pageNumber' => $nextPage->page_number]) }}" class="btn btn-primary">Next Page</a>
                    @elseif ($nextChapter)
                    <a href="{{ route('novel.read', ['novelId' => $novel->id, 'chapterNumber' => $nextChapter->chapter_number, 'pageNumber' => 1]) }}" class="btn btn-primary">Next Chapter</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const bookmarkedContent = document.getElementById('bookmarked-content');
    const bookmarkButton = document.getElementById('bookmark-button');
    const pageId = '{{ $page->id }}';
    const bookmarkedText = '{{ $page->bookmark_text }}';

    // Periksa apakah ada teks bookmark
    $(document).ready(function() {
        // Ambil teks bookmark dari PHP
        const bookmarkedText = '{{ $page->bookmark_text }}';

        if (bookmarkedText) {
            // Temukan semua kalimat yang di-bookmark pada halaman
            const bookmarkedContent = document.getElementById('bookmarked-content');
            const content = bookmarkedContent.innerHTML;

            // Temukan dan tandai setiap kemunculan teks bookmark
            const bookmarkedTextEscaped = bookmarkedText.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'); // Escape karakter khusus
            const re = new RegExp(bookmarkedTextEscaped, 'g');
            const replacedContent = content.replace(re, `<span style="background-color: yellow;">${bookmarkedText}</span>`);

            // Update konten dengan kalimat yang sudah ditandai
            bookmarkedContent.innerHTML = replacedContent;
        }
    });

    bookmarkedContent.addEventListener('mouseup', function(event) {
        const selectedText = window.getSelection().toString();

        if (selectedText.trim() !== '') {
            // Tampilkan tombol bookmark
            bookmarkButton.style.display = 'inline-block';
            bookmarkButton.style.top = `${event.clientY}px`;
            bookmarkButton.style.left = `${event.clientX}px`;

            // Tandai teks yang dipilih dengan warna kuning
            document.execCommand('hiliteColor', false, 'yellow');
        }
    });

    bookmarkButton.addEventListener('click', function() {
        const selectedText = window.getSelection().toString();

        // Kirim teks yang dipilih dan ID halaman ke server
        fetch('/bookmark', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Pastikan CSRF token tersedia
                },
                body: JSON.stringify({
                    bookmark_text: selectedText,
                    page_id: pageId,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });

        // Sembunyikan tombol bookmark
        bookmarkButton.style.display = 'none';
    });

    const removeBookmarksButton = document.getElementById('remove-bookmarks');

    removeBookmarksButton.addEventListener('click', function() {
        // Kirim permintaan untuk menghapus bookmark dari halaman
        fetch('/remove-bookmarks', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Pastikan CSRF token tersedia
                },
                body: JSON.stringify({
                    page_id: pageId,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);

                // Hapus warna kuning dari kalimat bookmark
                const bookmarkedTextElements = document.querySelectorAll('[data-bookmark="true"]');
                bookmarkedTextElements.forEach(element => {
                    element.style.backgroundColor = 'transparent';
                    element.removeAttribute('data-bookmark'); // Hapus atribut data-bookmark
                });
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
    });
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>