<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 
use Auth; 


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
            'name' => 'required|string|max:12',
            'email' => 'required|string|email|max:255|unique:users',
            'language' => 'required|string|max:12',
            'address' => 'required|string|max:12',
            'self_introduction' => 'required|string|max:255',
        ];
    }
}
