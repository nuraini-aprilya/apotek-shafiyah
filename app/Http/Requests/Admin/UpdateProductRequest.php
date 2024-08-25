<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => 'required',
            'unit_id' => 'required',
            'brand_id' => 'required',
            'type_id' => 'required',
            'code' => 'required|numeric',
            'name' => 'required|string|max:255',
            'batch_number' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'min:0',
            'image' => 'nullable|max:1024|mimes:png,jpg',
            'information' => 'required|string',
        ];
    }
}
