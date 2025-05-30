<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LinkUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'url'         => ['required', 'string', 'max:255', 'url'],
            'platform_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique("links")->where(
                    function ($query) {
                        return $query->where("platform_id", $this->platform_id)
                                     ->where("campaign_id", $this->campaign->id);
                    })->ignore($this->campaign->id),
                'exists:platforms,id'
            ]
        ];
    }
}
