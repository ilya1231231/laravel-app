<?php

declare(strict_types=1);

namespace App\Models;

use App\MailSending\MailSendClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Contact extends Model
{
    public function giveMeAnswer()    //получаем обдин объект через Contact
    {
        return $this->hasOne(Answer::class);
    }

    public static function findEmail(string $email)
    {
        return self::where('email', $email)->first();
    }
    //Получаем последюю дату отправки с этого email
    public static function getLatestEmailsDate(string $email)
    {
        return self::where('email', $email)->latest()->value('created_at');
    }
    //Получаем данные и сохраняем
    public function takeContactData($request)
    {
        $this->email = $request->email;
        $this->message = $request->msg;
        $this->name = $request->name;
        $this-> topic = $request->topic;

        $this->save();
        MailSendClass::takeParamsForMailtoAdmin($request);
        return redirect('reviews')->with('success', 'Сообщение отпрвалено');
    }
}
