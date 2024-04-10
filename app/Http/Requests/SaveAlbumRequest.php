<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveAlbumRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'pictures.*.name' => ['required', 'min:3', 'max:255'],
            'pictures.*.path' => ['required', 'image'],
        ];
    }
}
