<?php

namespace App\Http\Controllers;

//panggil model NovelModel
use App\Models\Novel;
use App\Models\Chapter;
use App\Models\Page;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    public function indexF()
    {
        $novels = Novel::all();
        return view('novel.indexF', compact('novels'));
    }

    public function index()
    {
        $novels = Novel::all();
        return view('novel.index', compact('novels'));
    }

    public function create()
    {
        return view('novel.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cover_image' => 'required',
            'title' => 'required',
            'genre' => 'required',
            'author' => 'required',
            'sinopsis' => 'required'
        ]);

        Novel::create($data);

        return redirect()->route('home')->with('success', 'Novel added successfully.');
    }

    public function chaptercreate()
    {
        $novels = Novel::all();
        return view('chapter.create', compact('novels'));
    }


    public function chapterstore(Request $request)
    {
        $data = $request->validate([
            'novel_id' => 'required|exists:novels,id',
            'chapter_number' => 'required|integer',
            'title' => 'required',
        ]);

        $existingChapter = Chapter::where('novel_id', $data['novel_id'])
            ->where('chapter_number', $data['chapter_number'])
            ->first();

        if ($existingChapter) {
            return redirect()->back()->with('error', 'Chapter with the same number already exists in this novel.');
        }

        Chapter::create($data);

        return redirect()->route('novel.index')->with('success', 'Chapter added successfully.');
    }

    public function pagecreate()
    {
        $novels = Novel::with('chapters')->get();
        $chapters = Chapter::all();

        return view('page.create', compact('novels', 'chapters'));
    }

    public function pagestore(Request $request)
    {
        $data = $request->validate([
            'chapter_id' => 'required|exists:chapters,id',
            'page_number' => 'required|integer',
            'content' => 'required',
        ]);

        Page::create($data);

        return redirect()->route('home')->with('success', 'Chapter added successfully.');
    }

    public function show($novelId)
    {
        $novel = Novel::findOrFail($novelId);
        $chapters = $novel->chapters; // Hubungan one-to-many antara Novel dan Chapter
        $pages = $novel->pages; // Hubungan one-to-many antara Novel dan Page

        // Ambil halaman terakhir dari semua chapters
        $lastPages = Page::whereIn('chapter_id', $chapters->pluck('id'))
            ->orderBy('chapter_id')
            ->orderBy('page_number', 'desc')
            ->distinct('chapter_id')
            ->get();

        // dd($novel, $chapters, $pages);
        return view('novel.show', compact('novel', 'chapters', 'pages', 'lastPages'));
    }

    public function edit($novelId)
    {
        $novel = Novel::findOrFail($novelId);
        return view('novel.edit', compact('novel'));
    }

    public function update(Request $request, $novelId)
    {
        $novel = Novel::findOrFail($novelId);

        $data = $request->validate([
            'cover_image' => 'required',
            'title' => 'required',
            'genre' => 'required',
            'author' => 'required',
            'sinopsis' => 'required',
            // validasi lainnya untuk cover image jika diperlukan
        ]);

        // Update informasi novel
        $novel->update($data);

        return redirect()->route('novel.show', ['novelId' => $novelId])->with('success', 'Novel updated successfully.');
    }

    public function chapterEdit($novelId, $chapterNumber)
    {
        $chapter = Chapter::where('novel_id', $novelId)
            ->where('chapter_number', $chapterNumber)
            ->firstOrFail();

        return view('chapter.edit', compact('chapter'));
    }

    public function chapterUpdate(Request $request, $novelId, $chapterNumber)
    {
        $chapter = Chapter::where('novel_id', $novelId)
            ->where('chapter_number', $chapterNumber)
            ->firstOrFail();

        $data = $request->validate([
            'title' => 'required',
            // Validasi lainnya sesuai kebutuhan
        ]);

        // Update informasi chapter
        $chapter->update($data);

        return redirect()->route('novel.show', ['novelId' => $novelId, 'chapterNumber' => $chapterNumber])
            ->with('success', 'Chapter updated successfully.');
    }

    public function pageEdit($chapterId, $pageNumber)
    {
        $page = Page::where('chapter_id', $chapterId)
            ->where('page_number', $pageNumber)
            ->firstOrFail();

        return view('page.edit', compact('page'));
    }

    public function pageUpdate(Request $request, $novelId, $chapterNumber, $pageNumber)
    {
        $page = Page::where('novel_id', $novelId)
            ->where('chapter_number', $chapterNumber)
            ->where('page_number', $pageNumber)
            ->firstOrFail();

        $data = $request->validate([
            'content' => 'required',
            // Validasi lainnya sesuai kebutuhan
        ]);

        // Update informasi page
        $page->update($data);

        return redirect()->route('novel.show', ['novelId' => $novelId, 'chapterNumber' => $chapterNumber, 'pageNumber' => $pageNumber])
            ->with('success', 'Page updated successfully.');
    }

    public function destroy($novelId)
    {
        $novel = Novel::findOrFail($novelId);

        // Ambil semua chapter yang terkait dengan novel ini
        $chapters = $novel->chapters;

        // Loop melalui semua chapter
        foreach ($chapters as $chapter) {
            // Hapus halaman (page) yang terkait dengan chapter ini
            $chapter->pages()->delete();

            // Hapus chapter
            $chapter->delete();
        }

        // Hapus novel itu sendiri
        $novel->delete();

        return redirect()->route('novel.index')->with('success', 'Novel, chapters, and pages deleted successfully.');
    }

    public function read($novelId, $chapterNumber, $pageNumber)
    {
        $novel = Novel::findOrFail($novelId);

        // Cari chapter berdasarkan nomor
        $chapter = Chapter::where('novel_id', $novelId)
            ->where('chapter_number', $chapterNumber)
            ->first();

        if (!$chapter) {
            // Chapter yang diminta tidak ada, maka arahkan ke chapter pertama jika ada
            $firstChapter = Chapter::where('novel_id', $novelId)
                ->orderBy('chapter_number')
                ->first();

            if ($firstChapter) {
                return redirect()->route('novel.read', [
                    'novelId' => $novel->id,
                    'chapterNumber' => $firstChapter->chapter_number,
                    'pageNumber' => 1, // Halaman pertama
                ]);
            } else {
                // Tidak ada chapter yang tersedia, berikan tanggapan sesuai kebutuhan
                abort(404);
            }
        }

        $page = Page::where('chapter_id', $chapter->id)
            ->where('page_number', $pageNumber)
            ->firstOrFail();

        $previousPage = Page::where('chapter_id', $chapter->id)
            ->where('page_number', '<', $pageNumber)
            ->orderBy('page_number', 'desc')
            ->first();

        $previousChapter = Chapter::where('novel_id', $novelId)
            ->where('chapter_number', '<', $chapterNumber)
            ->orderBy('chapter_number', 'desc')
            ->first();

        $lastPageOfPreviousChapter = null;

        if ($previousChapter) {
            // Cari nomor halaman terakhir dalam chapter sebelumnya
            $lastPageOfPreviousChapter = Page::where('chapter_id', $previousChapter->id)
                ->orderBy('page_number', 'desc')
                ->first();
        }

        $isLastPage = Page::where('chapter_id', $chapter->id)
            ->where('page_number', '>', $pageNumber)
            ->doesntExist();

        $nextPage = Page::where('chapter_id', $chapter->id)
            ->where('page_number', '>', $pageNumber)
            ->orderBy('page_number')
            ->first();

        $nextChapter = Chapter::where('novel_id', $novelId)
            ->where('chapter_number', '>', $chapterNumber)
            ->orderBy('chapter_number')
            ->first();

        return view('novel.read', compact('novel', 'chapter', 'page', 'previousPage', 'previousChapter', 'lastPageOfPreviousChapter', 'isLastPage', 'nextChapter', 'nextPage'));
    }

    public function addToFavorites($novelId)
    {
        $novel = Novel::findOrFail($novelId);

        // Ubah status_favorit menjadi 1
        $novel->update(['status_favorit' => 1]);

        return redirect()->back()->with('success', 'Novel ditambahkan ke Favorit.');
    }

    public function removeFromFavorites($novelId)
    {
        $novel = Novel::findOrFail($novelId);

        // Ubah status_favorit menjadi 0 (hapus dari Favorit)
        $novel->update(['status_favorit' => 0]);

        return redirect()->back()->with('success', 'Novel dihapus dari Favorit.');
    }

    public function favorit()
    {
        $favoritedNovels = Novel::where('status_favorit', 1)->get();

        return view('novel.favorit', compact('favoritedNovels'));
    }

    public function saveBookmark(Request $request)
    {
        $selectedText = $request->input('bookmark_text');
        $pageId = $request->input('page_id');

        $page = Page::find($pageId);

        if ($page) {
            // Simpan teks bookmark dalam kolom 'bookmark_text' di tabel 'pages'
            $page->update(['bookmark_text' => $selectedText]);

            return response()->json(['message' => 'Bookmark berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Halaman tidak ditemukan.'], 404);
        }
    }

    public function remove(Request $request)
    {
        $pageId = $request->input('page_id');

        // Cari halaman berdasarkan ID
        $page = Page::find($pageId);

        if ($page) {
            // Hapus teks bookmark dari halaman dan simpan perubahan ke database
            $page->update(['bookmark_text' => null]);

            return response()->json(['message' => 'Bookmark dihapus.']);
        } else {
            return response()->json(['message' => 'Halaman tidak ditemukan.'], 404);
        }
    }
}
