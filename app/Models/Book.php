<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

    public function insert($data)
    {
        return DB::table('books')->insert($data);
    }

    public function detail($id)
    {
        return DB::table('books')
            ->where('id', $id)
            ->first();
    }

    public function list()
    {
        return DB::table('books')
            ->paginate(5)
            ->appends(request()->query());
    }
}
