<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRecord extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ip' => 'required|ip',
            'type' => 'required|in:ipv4,ipv6',
            'continent_code' => 'nullable|string|min:2|max:5',
            'continent_name' => 'nullable|string|min:5|max:50',
            'country_code' => 'nullable|string|min:2|max:5',
            'country_name' => 'nullable|string|min:2|max:100',
            'region_code' => 'nullable|string|min:2|max:255',
            'city' => 'nullable|string|min:2|max:255',
            'zip' => 'nullable|string|min:2|max:255',
        ];
    }
}
