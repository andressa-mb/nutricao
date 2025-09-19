<?php

namespace App\Http\Requests\Foods;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'nullable|file|image|max:2048',
            'food_name' => 'required|string|max:150',
            'quantity' => 'required|numeric',
            'measure_type' => 'required|string|max:30',
            'energy_value' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
            'sugars' => 'nullable|numeric',
            'proteins' => 'nullable|numeric',
            'fats' => 'nullable|numeric',
            'dietary_fiber' => 'nullable|numeric',
            'sodium' => 'nullable|numeric',
            'other' => 'nullable|numeric',
            'group_type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.image' => 'O arquivo deve ser uma imagem, ex dos formatos: png, jpg ou jpeg, etc.',
            'image.max' => 'Arquivo grande, limite de 2MB.',
            'food_name.required' => 'O nome do alimento é obrigatório.',
            'food_name.max' => 'Passou do limite de caracteres, máximo de 150.',
            'quantity.required' => 'Quantidade obrigatória.',
            'quantity.numeric' => 'Quantidade deve ser numérico.',
            'measure_type.required' => 'Medida é obrigatória.',
            'energy_value.required' => 'Valor energético é obrigatório.',
            'energy_value.numeric' => 'Valor energético deve ser numérico.',
            'carbohydrates.required' => 'Carboidratos é obrigatório.',
            'carbohydrates.numeric' => 'Carboidratos deve ser numérico.',
            'sugars.numeric' => 'Açúcares deve ser numérico.',
            'proteins.numeric' => 'Proteína deve ser numérico.',
            'fats.numeric' => 'Gordura deve ser numérico.',
            'dietary_fiber.numeric' => 'Fibra deve ser numérico.',
            'sodium.numeric' => 'Sódio deve ser numérico.',
            'other.numeric' => 'Outros deve ser numérico.',
            'group_type.required' => 'Tipo de alimento é obrigatório.',
        ];
    }
}
