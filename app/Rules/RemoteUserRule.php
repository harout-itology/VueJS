<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RemoteUserRule implements Rule
{

    public function passes($attribute, $value)
    {   
        $remoteUser = remoteLinUser();
        if($remoteUser['error'] || $value != $remoteUser['name'])
            return false;
        return true;
    }


    public function message()
    {
        return 'Device username is not capability with your request username.';
    }
}
