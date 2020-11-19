<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; //ここを追加
use Auth; //ここを追加


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
        $myEmail = Auth::user()->email;

        return [
            'name' => 'required|string|max:15',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->whereNot('email', $myEmail)
            ],
            'language' => 'required|string|max:15',
            'address' => 'required|string|max:15',
            'self_introduction' => 'required|string|max:255',
        ];
    }
}
