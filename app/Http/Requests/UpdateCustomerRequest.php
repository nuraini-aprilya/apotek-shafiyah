<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required',
            'phone_number' => 'required',
            'province' => 'required',
            'district' => 'required',
            'subdistrict' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ];
    }
}
