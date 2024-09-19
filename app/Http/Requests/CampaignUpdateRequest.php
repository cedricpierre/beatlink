<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'min:10', 'max:255'],
            'slug' => ['sometimes', 'string', 'min:10', 'max:255', 'unique:campaigns,slug,' . $this->campaign->id],
            'description'    => ['sometimes', 'nullable', 'string'],
            'image_url'      => ['sometimes', 'nullable', 'string'],
            'background_url' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
