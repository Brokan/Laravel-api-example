<?php

namespace App\Http\Requests\Api\Guest\Clients;

use App\Http\Requests\Request;

class CreateClientRequest extends Request
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
            'firstName' => 'required|min:2|max:32',
            'lastName' => 'required|min:2|max:32',
            'email' => 'required|email',
            'phone' => 'required',
        ];
        /* function ($attribute, $value, $fail) {
             
function format_E164($num) {

    $phoneUtil = PhoneNumberUtil::getInstance();
    try {
        $num = $phoneUtil->parse($num);
    } catch (NumberParseException $e) {
        var_dump($e);
    }

    return $phoneUtil->format($num, \libphonenumber\PhoneNumberFormat::E164);
}

            $phoneNumber = PhoneNumber::make($value);

            if (!$phoneNumber->isValidFormat(PhoneNumberFormat::E164)) {
                $fail('The field ' . $attribute . ' contains an invalid phone number. It has to be in the E.164 format (starting with +)');
            }
        }*/
    }
    
    /**
     * Error messages.
     * @return array
     */
    public function messages(): array {
        return [
            'firstName.required' => 'Required first name',
            'lastName.required' => 'Required last name',
            'email.required' => 'Required e-mail',
            'email.email' => 'Not valid e-mail',
            'phone.required' => 'Required phone',
        ];
    }
}
