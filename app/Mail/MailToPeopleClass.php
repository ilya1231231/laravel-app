<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailToPeopleClass extends Mailable
{
    use Queueable, SerializesModels;

    protected $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($text )
    {
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail-to-people')
        ->with([
          'text'=>$this->text,

            ]);


    }
}
