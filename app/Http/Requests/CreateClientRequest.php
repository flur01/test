<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
            'client_name' => 'required|string|max:100|unique:clients',
            'address1' => 'required|string|max:65535',
            'address2' => 'required|string|max:65535',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'zip' => 'required|digits_between:2,10',
            'phone_no1' => 'required|string|max:20',
            'phone_no2' => 'string|max:20|nullable',
            'user' => 'required|array',
            'user.first_name' => 'required|string|max:50',
            'user.last_name' => 'required|string|max:50',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|string|confirmed|max:256',
            'user.phone' => 'required|string|max:20|unique:users,phone',
        ];
    }
}
