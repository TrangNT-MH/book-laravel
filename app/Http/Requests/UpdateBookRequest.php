<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'bail|required|string',
            'isbn10' => 'bail|required|regex:/([0-9X]{10}$)/|unique:books,isbn10,'. $this->id,
            'author' => 'bail|required|string',
            'price' => 'bail|required|decimal:2',
            'publication_date' => 'bail|required',
            'image' => 'bail|sometimes|required|image'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required for the book title.',
            'title.string' => 'The title must be a string for the book title.',
            'isbn10.required' => 'The isbn10 field is required for the ISBN-10.',
            'isbn10.unique' => 'The isbn10 must be unique for the ISBN-10.',
            'isbn10.regex' => 'The isbn10 must be a valid ISBN-10 format (containing 10 digits or "X").',
            'author.required' => "The author field is required for the author's name.",
            'author.string' => "The author must be a string for the author\'s name.",
            'price.required' => 'The price field is required for the book price.',
            'price.decimal' => 'The price must be a decimal number with 2 digits for the book price.',
            'publication_date.required' => 'The publication date field is required for the book publication date .',
            'image.image' => 'The image must be an image file.',
        ];
    }
}
