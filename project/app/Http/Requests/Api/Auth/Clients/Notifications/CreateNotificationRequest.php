<?php

namespace App\Http\Requests\Api\Auth\Clients\Notifications;

use App\Http\Requests\Request;

class CreateNotificationRequest extends Request
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
            'clientId' => 'required',
            'channel' => 'required',
            'content' => 'required|max:140',
        ];
    }
    
    /**
     * Error messages.
     * @return array
     */
    public function messages(): array {
        return [
            'clientId.required' => 'Required client ID',
            'channel.required' => 'Required channel',
            'content.required' => 'Required content',
        ];
    }
}
