<?php

namespace App\Models;

use App\Repositories\BookRepository;
use Gloudemans\Shoppingcart\Contracts\Buyable;
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

    public function scopeFilter($query, $filter)
    {
        return $filter->apply($query);
    }

    public function insert($data)
    {
        return DB::table('books')->insert($data);
    }

    public function list()
    {
        return DB::table('books')
            ->paginate(5)
            ->appends(request()->query());
    }
}
