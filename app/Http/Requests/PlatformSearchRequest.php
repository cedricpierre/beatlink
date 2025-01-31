<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatformSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => ['required', 'string', 'max:255'],
        ];
    }
}
