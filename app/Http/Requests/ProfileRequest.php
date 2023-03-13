<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
                'first_name' => ['max:50'],
                'last_name' => ['max:50'],
                'date_of_birth' => ['required'],
                'phone' => ['max:14'],
                'social_security_number' => ['max:14'],
                'street' => ['max:150'],
                'city' => ['max:100'],
                'state' => ['required'],
                'zip' => ['max:10'],
        ];
    }
}
