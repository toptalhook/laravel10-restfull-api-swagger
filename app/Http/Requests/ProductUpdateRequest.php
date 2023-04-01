<?php

namespace App\Http\Requests;

class ProductUpdateRequest extends ApiFormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'slug' => 'nullable|string|max:120|unique:products,slug,' . request()->id,
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ];
    }
}
