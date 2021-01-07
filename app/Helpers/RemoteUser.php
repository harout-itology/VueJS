<?php

if(!function_exists('remoteWinUser'))
{
    function remoteWinUser()
    {   
        try {
            $name = explode('@', $_SERVER['REMOTE_USER']);
            return [
                'error' => false,
                'name'  => $name[0],
                'type'  => $_SERVER['AUTH_TYPE']
            ];
        }
        catch (Exception $e){
            return  [
                'error' => true,
                'errorMessage' => 'Kerberos Authentication Failed',

            ];
        }
    }
}

if(!function_exists('remoteLinUser'))
{
    function remoteLinUser()
    {   
        try {
            $name = gethostname();
            return [
                'error' => false,
                'name'  => $name,
                'type'  => 'Standard Hostname for the Local Machine'
            ];
        }
        catch (Exception $e){
            return  [
                'error' => true,
                'errorMessage' => 'Hostname Authentication Failed',

            ];
        }
    }
}

if(!function_exists('dateFormat'))
{
    function dateFormat()
    {
        return 'Y-m-d H:i:s';
    }
}
