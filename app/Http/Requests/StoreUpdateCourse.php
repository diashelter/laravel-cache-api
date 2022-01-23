<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCourse extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $uuid = $this->couse ?? '';
        return [
            'name' => ['required', 'min:3', 'max:255', "unique:courses,name,{$uuid},uuid"],
            'description' => ['nullable', 'min:3', 'max:9999'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome deve ser informado',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo nome deve no máximo 255 caracteres',
            'name.unique' => 'Já existe um curso com o nome informado',
        ];
    }
}
