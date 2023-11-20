<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn10',
        'author',
        'publication_date',
        'price',
        'image'
    ];

    function insert($data)
    {
        return DB::table('books')->insert($data);
    }
}
