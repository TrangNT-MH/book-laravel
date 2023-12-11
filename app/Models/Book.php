<?php

namespace App\Models;

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

//    public function getBuyableIdentifier($options = null)
//    {
//        // TODO: Implement getBuyableIdentifier() method.
//        return $this->id;
//    }
//
//    public function getBuyableDescription($options = null)
//    {
//        // TODO: Implement getBuyableDescription() method.
//        return $this->description;
//    }
//
//    public function getBuyablePrice($options = null)
//    {
//        // TODO: Implement getBuyablePrice() method.
//        return $this->price;
//    }
//
//    public function getBuyableWeight($options = null)
//    {
//        // TODO: Implement getBuyableWeight() method.
//    }
}
