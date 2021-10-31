<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailClass extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $topic;
    protected $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $topic, $msg)
    {
        $this->name = $name;
        $this->email = $email;
        $this->topic = $topic;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail')
            ->with([
              'name'=>$this->name,
              'email'=>$this->email,
              'topic'=>$this->topic,
              'msg'=>$this->msg,
            ]);
    }
}
