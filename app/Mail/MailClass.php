<?php
declare(strict_types=1);
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailClass extends Mailable
{
    use Queueable, SerializesModels;

    protected string $name;
    protected string $email;
    protected string $topic;
    protected string $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $email, string $topic, string $msg)
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
        return $this->view('mail.mail')
            ->with([
              'name'=>$this->name,
              'email'=>$this->email,
              'topic'=>$this->topic,
              'msg'=>$this->msg,
            ]);
    }
}
