<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class BukuModel extends Model
// {
//     use HasFactory;
//     protected $table        = "buku";
//     protected $primaryKey   = "id";
//     protected $fillable     = ['id', 'judul', 'genre', 'penulis', 'file_pdf'];
// }

// app/Models/Novel.php
class Page extends Model
{
    protected $fillable = ['chapter_id', 'page_number', 'content', 'bookmark_text'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    // Tambahkan metode untuk mendapatkan novel
    public function novel()
    {
        return $this->belongsTo(Novel::class, 'novel_id', 'id');
    }
}

// class Novel extends Model
// {
//     use HasFactory;
//     protected $table        = "novels";
//     protected $primaryKey   = "id";
//     protected $fillable = ['title', 'genre', 'author'];

//     public function chapters()
//     {
//         return $this->hasMany(Chapter::class);
//     }
// }

// class Chapter extends Model
// {
//     protected $fillable = ['novel_id', 'chapter_number', 'title'];

//     public function novel()
//     {
//         return $this->belongsTo(Novel::class);
//     }

//     public function pages()
//     {
//         return $this->hasMany(Page::class);
//     }
// }