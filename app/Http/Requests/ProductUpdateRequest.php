<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:products,id',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'attributes' => 'required|array',
            'attributes.*.id' => 'required|exists:attributes,id',
            'attributes.*.values' => 'required|array|min:1',
            'attributes.*.values.*.label' => 'required',
            'attributes.*.values.*.value' => 'required',
            'attributes.*.values.*.price' => 'required|numeric',
            'attributes.*.values.*.sell_count' => 'required|integer',
        ];
    }
}
