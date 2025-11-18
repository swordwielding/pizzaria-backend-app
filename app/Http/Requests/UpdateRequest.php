<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            
            'name' => 'required|string|unique:products,name,' . $this->route('product')->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'is_available' => 'boolean',
        
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => 'Укажите название',
            'name.unique' => 'Название должно быть уникально',
            'price.required' => 'Укажите цену',
            'category_id.required' => 'Укажите категория',
        ];
    }
}
