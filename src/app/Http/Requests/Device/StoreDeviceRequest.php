<?php

namespace App\Http\Requests\Device;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'network_id' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'ip_addresses' => ['nullable', 'array'],
            'mac_address' => ['required', 'string', 'max:17', 'unique:devices,mac_address'],
            'device_type' => ['required', 'string'],
            'os' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ];
    }
}
