<?php

namespace App\Http\Requests;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Campaign $campaign
 */
class CampaignUploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'background' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
        ];
    }
}
