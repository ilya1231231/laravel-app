<?php
declare(strict_types=1);
namespace App\Http\Controllers;
use App\Models\{Contact, Answer};
use App\Mail\{MailClass, MailToPeopleClass};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use DateTime;


class MailSettingController extends Controller{
    //функция отправки данных отзыва на email админа
    public function takeParamsForMail(string $name, string $email, string $topic, string $msg){
        Mail::to('malygin.ilja@yandex.ru')->send(new MailClass($name, $email, $topic, $msg));
        return redirect('reviews')->with('success', 'Сообщение отпрвалено');
    }


    //Функция отправки отзыва от пользователя
    public function sendRiview(ContactRequest $request){

      $Review = new Contact();
      $email = $Review->email = $request->input('email');
      $msg = $Review->message = $request->input('msg');
      $name = $Review->name = $request->input('name')   ;
      $topic = $Review->topic = $request->input('topic');

      // Проверка email на повторную отпрывку отзыва
      if (Contact::where('email', $email)->first()){    //Если пользователь с таким email существует
          $userReviewDate = new DateTime((string) Contact::where('email',$email)->latest()->value('created_at'));   //То берем последнюю дату его оразения
          $nowDate = new DateTime();    //Заводим переменную с текущим временем
          $diffInHours = $userReviewDate->diff($nowDate);    // сравниваем их по датам
          if(($diffInHours->days * 24) + $diffInHours->h <= 24){    //получаем разницу дат в часах и сравниваем
              return redirect('/')->with('timeerror', 'Вы уже отправляли сообщение.Обратитесь позднее');
          }
        }

      $Review->save();
      return $this->takeParamsForMail($name, $email, $topic, $msg);
      }

      //Функция ответа на отзыв
      public function sendReplyToRiview(Request $request ,int $statusId ){

          $valid = $request->validate([
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
