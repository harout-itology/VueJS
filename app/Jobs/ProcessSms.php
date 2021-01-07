<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\TemplateLog;


class ProcessSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $recipientNumber;
    protected $remoteUser;
    public $tries = 3;
    public $sleep = 3;

    public function __construct($message, $recipientNumber, $remoteUser)
    {
        $this->message      = $message;
        $this->recipientNumber = $recipientNumber;
        $this->remoteUser   = $remoteUser;
    }

    public function handle()
    {
        $body = [ 
            'To' => $this->recipientNumber,
            'From' => '14808000490',
            'Body' => $this->message->message        
        ];

        $result = \Http::withBasicAuth('ACf812e689d7671b165d4bafc170d66da8', 'f38dc7134e3d19bd87230cce6c7e4dbe')
            ->asForm()
            ->post('https://api.twilio.com/2010-04-01/Accounts/ACf812e689d7671b165d4bafc170d66da8/Messages.json', $body);
        $this->logger($result->json());
    }


    public function logger($result)
    {   
        TemplateLog::create([
            'username'      =>   !($this->remoteUser)['error'] ? ($this->remoteUser)['name'] : 'LOCAL_ADMIN_DEVELOPER',
            'recipient_number'   => $this->recipientNumber,
            'message'      => $this->message->message,
            'result_code'    => isset($result['sid']) ? 1 : -1,
            'template_id'   => $this->message->id,
        ]);
    }
}
