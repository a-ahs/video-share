<?php

namespace App\Listeners;

use App\Events\VideoCreated;
use App\Mail\VideoCreated as MailVideoCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVideoCreatedEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VideoCreated $event): void
    {
        Mail::to($event->user->email)->send(new MailVideoCreated($event->user->name));
    }
}
