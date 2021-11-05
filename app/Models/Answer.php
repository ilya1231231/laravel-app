<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MailSending\MailSendClass;
use App\Models\Contact;

class Answer extends Model
{
    public function takeAnswerData($request, int $statusId)
    {
        $this->contact_id = $statusId;
        $text = $this->text = $request->input("text-$statusId");
        $this->save();
        $email= Contact::find($statusId)->email;
        MailSendClass::takeParamsForMailToReviewer($text, $email);
        return redirect('reviews')->with('success', 'Сообщение отпрвалено');
    }
}
