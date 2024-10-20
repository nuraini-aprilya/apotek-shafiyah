<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
            'product_id' => 'required',
            'supplier_id' => 'required',
            'purchase_number' => 'required',
            'invoice_number' => 'required',
            'order_date' => 'required',
            'expired_date' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total_price' => 'required',
            'information' => 'required',
        ];
    }
}
