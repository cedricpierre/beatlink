<?php

namespace App\Http\Requests;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @property Campaign $campaign
 */
class CampaignUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'           => ['sometimes', 'required', 'string', 'max:255'],
            'slug'           => ['sometimes', 'required', 'string', 'max:255', 'unique:campaigns,slug,' . $this->campaign->id],
            'description'    => ['sometimes', 'nullable', 'string'],
            'image_url'      => ['sometimes', 'nullable', 'string'],
            'background_url' => ['sometimes', 'nullable', 'string'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
                         'slug' => Str::slug($this->slug),
                     ]);
    }
}
