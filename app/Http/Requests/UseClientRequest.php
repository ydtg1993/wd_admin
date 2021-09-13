<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UseClientRequest extends FormRequest
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
            'nickname'  => 'required|string',
            'email'  => 'nullable|string',
            'pwd'  => 'string',
            'pwd_confirmation' => 'required_with:pwd|same:pwd|min:6',
            'type'  => 'required|int',
            'sex'  => 'required|int',
        ];
    }
}
