<?php

namespace App\Jobs;

use App\Mail\MailNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messages;
    protected $listUser;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($messages, $listUser)
    {
        $this->messages = $messages;
        $this->listUser = $listUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for ($i = 0; $i < count($this->listUser); $i++) {
            Mail::to($this->listUser[$i]->email)->send(new MailNotify($this->messages[$i]));
        }
    }
}
