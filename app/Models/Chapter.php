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

class Chapter extends Model
{
    protected $fillable = ['novel_id', 'chapter_number', 'title'];

    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'chapter_id', 'id');
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

// class Page extends Model
// {
//     protected $fillable = ['chapter_id', 'page_number', 'content'];

//     public function chapter()
//     {
//         return $this->belongsTo(Chapter::class);
//     }
// }
