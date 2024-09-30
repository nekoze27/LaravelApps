<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $food = $this->route('food');

        return $food && $this->user()->can('update', $food);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $foodId = $this->route('food') ? $this->route('food')->id : null;
        return [
            'name' => 'required|string|max:255|unique:food,name',
            'protein' => 'required|numeric|min:0',
            'carbs' => 'required|numeric|min:0',
            'fat' => 'required|numeric|min:0',
            'grams' => 'required|numeric|min:0',
            'food_type_name' => 'nullable|string|exists:food_types,name',
        ];
    }
}
