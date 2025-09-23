<?php

namespace App\Http\Requests\Profiles;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'user_id' => 'exists:App\User,id|unique:profiles,user_id',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'goal' => 'required|numeric',
            'metabolism' => 'nullable|numeric'
        ];
    }

    public function messages()
    {
        return [
            'image.image' => 'O arquivo deve ser uma imagem, ex dos formatos: png, jpg ou jpeg, etc.',
            'image.max' => 'Arquivo grande, limite de 2MB.',
            'user_id.exists' => 'O usuário selecionado não existe.',
            'user_id.unique' => 'Este usuário já possui um perfil.',
            'weight.required' => 'Peso é obrigatório.',
            'weight.numeric' => 'Peso deve ser um número.',
            'height.required' => 'Altura é obrigatório.',
            'height.numeric' => 'Altura deve ser um número.',
            'goal.required' => 'Sua meta de peso é obrigatório.',
            'goal.numeric' => 'Sua meta de peso deve ser um número.',
            'metabolism.numeric' => 'Seu metabolismo deve ser um número.'
        ];
    }
}
