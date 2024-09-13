<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->canCreateCampaign();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:campaigns,slug'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
                         'slug' => Str::slug($this->slug),
                     ]);
    }
}
