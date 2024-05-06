<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryProductRequest extends FormRequest
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
            'id' => [
                'required',
                'exists:products,id',
                function ($attribute, $value, $fail) {
                    $categoryId = $this->route('category');
                    $category = Category::with('products')->find($categoryId);  // Carga anticipada de productos.

                    if ($category && $category->products->contains('id', $value)) {
                        $fail('The product is already added to this category.');
                    }
                },
            ],
        ];
    }
}
