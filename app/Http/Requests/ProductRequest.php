<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $imgValidation = 'required';

        // image may not be required while updating products
        // since admin may not update image every single time
        if (Route::getCurrentRoute()->getActionMethod() === 'update') {
            
            $imgValidation = 'nullable';
        }

        return [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'price' => "required|numeric|min:1|max:1000000000",
            'image' => "{$imgValidation}|image|mimes:jpeg,jpg,png|max:2048",
            'category' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where(function ($query) {
                        return $query->where('deleted_at', null);
                    })
            ],
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }
}
