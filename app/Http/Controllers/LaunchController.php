<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendSmsRequest;
use App\Template;
use App\Jobs\ProcessSms;
use Carbon\Carbon;


class LaunchController extends Controller
{

    public function index()
    {
        return response()->json(remoteLinUser());
    }

    public function sendSms(SendSmsRequest $request)
    {
        $messages = Template::wherein('id', $request->SMSData)->get();
        $index = 0;
        foreach ($messages as $index => $message) {
            ProcessSms::dispatch($message, $request->recipientNumber, remoteLinUser())
                ->delay(($index+1)*Template::$delay);
        }
        return response()->json(($index+1).' requests added to the queue job');
    }

}
