<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLesson extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $uuid = $this->lesson ?? '';
        return [
            'module' => ['required', 'exists:modules,uuid'],
            'name' => ['required', 'min:3', 'max:255', "unique:lessons,name,{$uuid},uuid"],
            'video' => ['required', 'min:3', 'max:255', "unique:lessons,video,{$uuid},uuid"],
            'description' => ['nullable', 'min:3', 'max:9999'],
        ];
    }
}
