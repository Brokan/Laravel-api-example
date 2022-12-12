<?php

namespace App\Http\Requests\Api\Guest\Clients;

use App\Http\Requests\Request;

class UpdateClientRequest extends Request
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
            'id' => 'required',
            'firstName' => 'required|min:2|max:32',
            'lastName' => 'required|min:2|max:32',
            'email' => 'required|email',
            'phone' => 'required',
        ];
    }
    
    /**
     * Error messages.
     * @return array
     */
    public function messages(): array {
        return [
            'id.required' => 'Required Client id',
            'firstName.required' => 'Required first name',
            'lastName.required' => 'Required last name',
            'email.required' => 'Required e-mail',
            'email.email' => 'Not valid e-mail',
            'phone.required' => 'Required phone',
        ];
    }
}
