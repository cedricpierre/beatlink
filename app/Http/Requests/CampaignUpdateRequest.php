<?php

namespace App\Http\Requests;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Campaign $campaign
 */
class CampaignUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['required', 'string', 'max:255', 'unique:campaigns,slug,' . $this->campaign->id],
            'description' => ['nullable', 'string'],
        ];
    }
}
