<?php

namespace App\Http\Resources;

use App\Const\BookStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'isbn10' => $this->isbn10,
            'author' => $this->author,
            'price' => $this->price,
            'publication_date' => $this->publication_date,
            'image' => $this->image,
            'status' => BookStatus::BookStatus[$this->status]
        ];
    }
}
