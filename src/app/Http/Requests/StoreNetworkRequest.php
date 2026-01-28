<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNetworkRequest extends FormRequest
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
            'cidr' => ['required', 'string', 'max:43', 'unique:networks,cidr'],
            'location' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ];
    }
}
