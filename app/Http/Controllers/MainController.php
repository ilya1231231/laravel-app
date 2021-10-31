<?php
declare(strict_types=1);
namespace App\Http\Controllers;
use App\Models\{Contact, Answer};
use Illuminate\Http\Request;
use App\Mail\MailToPeopleClass;
use Illuminate\Support\Facades\Mail;


class MainController extends Controller{
    
    public function home(){
        return view('welcome');
    }

    public function showAllReviews(){
        $Reviews = new Contact();
        return view('allforms', ['reviews'=> $Reviews->all()]);   //Передаем контекстную переменную в шаблон пот именем 'reviews'
    }

    public function sendReplyToRiview(Request $request ,int $statusId ){

        $valid = $request->validate([   //валидируем данные
          "text-$statusId" => 'required|max:1024',
        ]);

        $Answer = new Answer();   //Создаем переменную с классом
        $Answer -> contact_id = $statusId;    //Записываем переменную statusId в contact_id(Id для связи)
        $text = $Answer -> text = $request->input("text-$statusId");   //получаем данные с реквеста,передаем текст с динамического параметра,обьявленного в форме

        $Answer->save();    //Сохраняю ответ
        $Contact = Contact::find($statusId);  //Ищу отзыв по его id
        Mail::to($Contact->email)->send(new MailToPeopleClass($text));
        return redirect('reviews')->with('success', 'Сообщение отпрвалено');
    }
}
