<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class taskInCompleteConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $task;

    public function __construct($task)
    {
        $this -> incompleteMessage = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {



        return $this->view('backend.mail.incomplete-mail-list')->with(['task' => $this->incompleteMessage]);
    }
}
