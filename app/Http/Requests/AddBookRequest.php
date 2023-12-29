<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddBookRequest extends FormRequest
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
            'isbn' => 'bail|required|unique:books|regex:/([0-9X]{13}$)/',
            'authors' => 'bail|required|string',
            'price' => 'bail|required|decimal:2',
            'description' => 'bail|required|string',
            'publisher' => 'bail|required|string',
            'genres[]' => 'bail|required',
            'page_count' => 'bail|required|string',
            'publish_date' => 'bail|required',
            'language' => 'bail|required',
            'image' => 'bail|required|image'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required for the book title.',
            'title.string' => 'The title must be a string for the book title.',
            'isbn.required' => 'The isbn field is required for the ISBN-10.',
            'isbn.unique' => 'The isbn must be unique for the ISBN-10.',
            'isbn.regex' => 'The isbn must be a valid ISBN-10 format (containing 13 digits or "X").',
            'authors.required' => "The author field is required for the author's name.",
            'authors.string' => "The author must be a string for the author\'s name.",
            'price.required' => 'The price field is required for the book price.',
            'price.decimal' => 'The price must be a decimal number with 2 digits for the book price.',
            'publication_date.required' => 'The publication date field is required for the book publication date .',
//            'image.image' => 'The image must be an image file.',
        ];
    }
}
