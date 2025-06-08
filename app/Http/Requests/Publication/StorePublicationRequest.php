<?php

namespace App\Http\Requests\Publication;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePublicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdministrator();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'owner' => 'string|required',
            'description' => 'string|required',
            'address' => 'string|required',
            'phone_number' => 'string|required',
            'city' => 'string',
            'country' => 'string|required'
        ];
    }
}
