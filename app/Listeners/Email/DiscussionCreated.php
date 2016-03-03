<?php

namespace App\Listeners\Email;

use App\Events\Discussion\Created;
use Config;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DiscussionCreated implements ShouldQueue
{

    protected $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
       $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  Created $event
     */
    public function handle(Created $event)
    {
        return; // just.. no need to get harrased while developing...
        $this->mailer->send('emails.discussionCreated', array ('discussion' => $event->discussion), function ($message) {
            $message->from(Config::get('mail.from_address'), Config::get('mail.from_name'));
            $message->to('propush@gmail.com', 'Herr Propush')->subject('test subject!');
        });
    }
}
