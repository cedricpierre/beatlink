<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionCancelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!password_verify($value, auth()->user()->password)) {
                        $fail('The provided password is incorrect.');
                    }
                }
            ],
        ];
    }
}
