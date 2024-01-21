@extends('indexwb')
@section('title', 'admin')

@section('isihalamanawal')

<div class="container mt-5" id="content-container" style="background-color: #f8f9fa; width:61%;">
    <a href="{{ route('novel.show', ['novelId' => $novel->id]) }}" class="btn btn-secondary mt-2" style="text-decoration: none;">
        Kembali
    </a>
    <div class="d-flex justify-content-center align-items-center">
        <a href="{{ route('novel.chapterEdit', ['novelId' => $chapter->novel_id, 'chapterNumber' => $chapter->chapter_number]) }}" class="btn btn-primary btn-sm mb-2 mt-2">Ubah Judul Bab</a>
        <a href="{{ route('novel.pageEdit', ['chapterId' => $page->chapter_id, 'pageNumber' => $page->page_number]) }}" class="btn btn-primary btn-sm mb-2 mx-3 mt-2">Ubah Halaman {{ $page->page_number }}</a>
    </div>


    <h1 id="novel-title" class="text-center">{{ $novel->title }}</h1>
    <h2 id="chapter-title" class="text-center">Bab {{ $chapter->chapter_number }}</h2>

    <div class="d-flex justify-content-center align-items-center" style="min-height: 400px;">
        <div id="bookmarked-content" contentEditable="false" class="mb-2 readonly">
            {!! $page->content !!}
        </div>
    </div>

    <div class="dropdown-container">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="logo-a">A</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="p-3">
                    <label for="fontSlider">Ukuran Font</label>
                    <input class="ms-5" type="range" id="fontSlider" min="10" max="30" step="1" value="16">
                </div>
                <div class="p-3">
                    <label for="lineSpacingSlider">Jarak Antara Baris</label>
                    <input type="range" id="lineSpacingSlider" min="1" max="3" step="0.1" value="2.5">
                </div>
            </div>
        </div>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="backgroundColorDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <a style="color: black;">Warna Latar</a>
            </button>
            <div class="dropdown-menu" aria-labelledby="backgroundColorDropdown">
                <button class="dropdown-item" style="background-color: #ffffff;" onclick="changeBackgroundColor('#ffffff')">Putih</button>
                <button class="dropdown-item" style="background-color: #7FFFD4;" onclick="changeBackgroundColor('#7FFFD4')">Aqua</button>
                <button class="dropdown-item" style="background-color: #FA8072" onclick="changeBackgroundColor('#FA8072')">Salmon</button>
                <button class="dropdown-item" style="background-color: grey;" onclick="changeBackgroundColor('grey')">Abu - Abu</button>
                <button class="dropdown-item" style="background-color: black;" onclick="changeBackgroundColor('black')">Hitam</button>
            </div>
        </div>
    </div>

    <h4 id="chapter-page" class="text-center">Halaman {!! $page->page_number !!}</h4>
    <button id="bookmark-button" class="btn btn-warning" style="display: none;">Bookmark</button>
    <!-- <button id="remove-bookmarks" class="btn btn-danger">Hapus Bookmark</button> -->

    <div class="pagination mt-3">
        <div class="row">
            <div class="col-md-6 text-md-end">
                @if ($previousPage)
                <a href="{{ route('novel.read', ['novelId' => $novel->id, 'chapterNumber' => $chapter->chapter_number, 'pageNumber' => $previousPage->page_number]) }}" class="btn btn-primary mb-2">Previous Page</a>
                @elseif ($previousChapter && $lastPageOfPreviousChapter)
                <a href="{{ route('novel.read', ['novelId' => $novel->id, 'chapterNumber' => $previousChapter->chapter_number, 'pageNumber' => $lastPageOfPreviousChapter->page_number]) }}" class="btn btn-primary mb-2">Previous Chapter</a>
                @endif
            </div>
            <div class="col-md-6 text-md-end justify-content-end">
                @if (!$isLastPage)
                <a href="{{ route('novel.read', ['novelId' => $novel->id, 'chapterNumber' => $chapter->chapter_number, 'pageNumber' => $nextPage->page_number]) }}" class="btn btn-primary mb-3">Next Page</a>
                @elseif ($nextChapter)
                <a href="{{ route('novel.read', ['novelId' => $novel->id, 'chapterNumber' => $nextChapter->chapter_number, 'pageNumber' => 1]) }}" class="btn btn-primary mb-3">Next Chapter</a>
                @endif
            </div>
        </div>
    </div>

</div>
</body>
<script>
    // Ubah warna
    function changeBackgroundColor(color) {
        const contentContainer = document.getElementById('content-container');
        const novelTitleElement = document.getElementById('novel-title');
        const chapterTitleElement = document.getElementById('chapter-title');
        const chapterPageElement = document.getElementById('chapter-page');
        const contentElement = document.getElementById('bookmarked-content');

        // Mengatur warna latar
        contentContainer.style.backgroundColor = color;

        // Mengatur warna teks berdasarkan warna latar
        const isLight = isLightColor(color);
        novelTitleElement.style.color = isLight ? 'black' : 'white';
        chapterTitleElement.style.color = isLight ? 'black' : 'white';
        chapterPageElement.style.color = isLight ? 'black' : 'white';
        contentElement.style.color = isLight ? 'black' : 'white';
    }

    // Fungsi untuk mengecek apakah suatu warna termasuk warna terang atau gelap
    function isLightColor(color) {

        color = color.replace(/^#/, '');

        // Memisahkan nilai RGB
        const bigint = parseInt(color, 16);
        const r = (bigint >> 16) & 255;
        const g = (bigint >> 8) & 255;
        const b = bigint & 255;

        // Hitung kecerahan
        const brightness = (r * 299 + g * 587 + b * 114) / 1000;

        // Jika kecerahan kurang dari 128, itu dianggap warna gelap
        return brightness >= 128;
    }

    const fontSlider = document.getElementById('fontSlider');
    const lineSpacingSlider = document.getElementById('lineSpacingSlider');
    const contentElement = document.getElementById('bookmarked-content');

    // Ukuran teks
    fontSlider.addEventListener('input', function() {
        const fontSize = this.value + 'px';
        contentElement.style.fontSize = fontSize;
    });

    // Spasi baris
    lineSpacingSlider.addEventListener('input', function() {
        const lineSpacing = this.value;
        contentElement.style.lineHeight = lineSpacing;
    });

    const bookmarkedContent = document.getElementById('bookmarked-content');
    const bookmarkButton = document.getElementById('bookmark-button');
    const pageId = '{{ $page->id }}';
    const bookmarkedText = '{{ $page->bookmark_text }}';

    bookmarkedContent.addEventListener('mouseup', function(event) {
        const selectedText = window.getSelection().toString();

        if (selectedText.trim() !== '') {
            const span = document.createElement('span');
            span.textContent = selectedText;
            span.style.backgroundColor = 'yellow';
            span.style.cursor = 'pointer';

            // Tambahkan ID atau kelas tertentu untuk menangkap klik
            span.addEventListener('click', function() {
                // Lakukan sesuatu ketika teks diklik
                alert('Teks diklik: ' + selectedText);
            });

            // Ganti teks yang dipilih dengan elemen span yang diatur
            const range = window.getSelection().getRangeAt(0);
            range.deleteContents();
            range.insertNode(span);
        }
    });

    // Periksa apakah ada teks bookmark
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil teks bookmark dari PHP
        const bookmarkedText = '{{ $page->bookmark_text }}';

        if (bookmarkedText) {
            // Temukan semua kalimat yang di-bookmark pada halaman
            const content = bookmarkedContent.innerHTML;

            // Temukan dan tandai setiap kemunculan teks bookmark
            const bookmarkedTextEscaped = bookmarkedText.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'); // Escape karakter khusus
            const re = new RegExp(bookmarkedTextEscaped, 'g');
            const replacedContent = content.replace(re, `<span style="background-color: #EE7214;">${bookmarkedText}</span>`);

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
                // Sembunyikan tombol bookmark setelah berhasil bookmark
                bookmarkButton.style.display = 'none';
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
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

@endsection