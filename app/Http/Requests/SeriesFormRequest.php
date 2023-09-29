<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'min:3'],
            'seasonsQty' => ['required'],
            'episodesPerSeason' => ['required'],
            'cover' => ['required', 'image']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo "nome" é obrigatório!',
            'nome.min' => 'O campo "nome" precisa de pelo menos :min caracteres!',
            'seasonsQty.required' => 'O campo "Temporadas" é obrigatório!',
            'episodesPerSeason.required' => 'O campo "Episodios" é obrigatório!',
            'cover.required' => 'O campo "Capa" é obrigatório',
            'cover.image' => 'Formato de imagem inválido'
        ];
    }
}
