<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class SaveAlbumPictureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can('any', $this->album);
    }

    public function rules(): array
    {
        return [
            'pictures.*.name' => ['required', 'min:3', 'max:255'],
            'pictures.*.path' => ['required', 'image', 'max:10240']
        ];
    }

    public function attributes(): array
    {
        return [
            'pictures.*.name' => "picture name",
            'pictures.*.path' => "picture",
        ];
    }
}
