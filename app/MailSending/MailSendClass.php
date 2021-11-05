<?php

declare(strict_types=1);

namespace App\MailSending;

use Illuminate\Support\Facades\Mail;
use App\Mail\{MailClass, MailToPeopleClass};
use Config;

class MailSendClass
{
    public static function takeParamsForMailtoAdmin($request)
    {
        $data = array(
          'name'=>$request->name,
          'topic'=>$request->topic,
          'email'=>$request->email,
          'msg'=>$request->msg,
          );
        Mail::send('mail.mail',$data, function ($m)
        {
          $m->from(config('mail.from.address'));
          $m->to(config('mail.to.admin'));
        });
    }

    public static function takeParamsForMailtoReviewer(string $text, string $email)
    {
        Mail::send('mail.mail-to-people',['text'=>$text], function ($m) use ($email)
        {
          $m->from(config('mail.from.address'));
          $m->to($email);
        });
    }
}
