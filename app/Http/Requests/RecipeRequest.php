<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'instructions' => 'required|string',
            'preparation_time' => 'required|string|max:100',
            'servings' => 'required|integer|min:1',
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'required|exists:ingredients,id',
            'ingredient_quantities' => 'required|array|min:1',
            'ingredient_quantities.*' => 'required|numeric|min:0.01',
        ];
    }
}
