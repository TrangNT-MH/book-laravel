<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
