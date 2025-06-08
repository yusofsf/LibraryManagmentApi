<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isLibrarian();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|required|unique:books,title',
            'author' => 'string|required',
            'description' => 'string|required',
            'page_count' => 'numeric|required',
            'release' => 'string|required',
            'ISBN' => 'string|required|unique:books,ISBN'
        ];
    }
}
