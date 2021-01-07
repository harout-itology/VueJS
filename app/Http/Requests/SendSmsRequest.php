<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\RemoteUserRule;

class SendSmsRequest extends FormRequest
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
            'recipientNumber'   => ['required', 'numeric', 'digits:11'],
            'username'          => ['required' ,'string', new RemoteUserRule()],
            'SMSData'           => ['required', 'array']
        ];
    }
}
