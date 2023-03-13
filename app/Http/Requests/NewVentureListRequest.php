<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewVentureListRequest extends FormRequest
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
            /**
             * TODO: use this validation for future work 
             * 'file' => 'required',
             * 'images' => 'required',
             * 'documentName' => 'required',
             */
            'description' => 'required|max:3000',
        ];
    }
}
