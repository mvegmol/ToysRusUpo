<?php

namespace App\Rules;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Log;

class UniqueCategoryProduct implements ValidationRule
{
    protected $category;

    /**
     * Create a new rule instance.
     *
     * @param  int  $categoryId
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Validation\ValidationException  $fail
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {                              
        if ($this->category->products()->where('product_id', $value)->exists()) {
            $fail('The product is already associated with this category.');
        }
    }
}
