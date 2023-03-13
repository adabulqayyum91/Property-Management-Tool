<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentureCreate extends FormRequest
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
            'venture_name' => 'required|max:191',
            'initial_cap' => 'required|numeric',
            'venture_street' => 'max:191',
            'venture_type' => 'required',
            'venture_source_type' => 'required',
            'venture_status' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            'property_street' => 'required',
            'property_city' => 'required',
            'property_zip' => 'required',
            'target_amount' => 'required',
        ];

    }
}
