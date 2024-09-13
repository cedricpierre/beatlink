<?php

namespace App\Http\Requests;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', 'unique:campaigns,slug,' . $this->campaign->id],
            'description'    => ['sometimes', 'nullable', 'string'],
            'image_url'      => ['sometimes', 'nullable', 'string'],
            'background_url' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
