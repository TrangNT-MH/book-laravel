<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

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

    public function books() : HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function insert($data)
    {
        return DB::table('books')->insert($data);
    }

    public function search($keys)
    {
        $keys = explode(' ', $keys);
        return $this->books()::whereHas('keys', function (Builder $query) use($keys)
        {
            foreach ($keys as $key)
            {
                $query->orWhere('title', 'like', '%' . $key . '%');
            }
        })->get();
    }
}
