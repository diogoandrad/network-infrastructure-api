<?php

namespace App\Http\Requests\Network;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNetworkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'cidr' => ['required', 'string', 'max:43',
                Rule::unique('networks', 'cidr')->ignore($this->route('id')),
            ],
            'location' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ];
    }
}
