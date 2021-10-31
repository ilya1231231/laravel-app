<?php
declare(strict_types=1);
namespace App\Http\Controllers;
use App\Models\Contact;
use App\Mail\MailClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DateTime;


class MailSettingController extends Controller
{
    public function takeParamsForMail(string $name, string $email, string $topic, string $msg){
        Mail::to('malygin.ilja@yandex.ru')->send(new MailClass($name, $email, $topic, $msg));
        return redirect('reviews')->with('success', 'Сообщение отпрвалено');
    }



    public function sendRiview(Request $request)
    {

      $valid = $request->validate([   //валидируем данные
        'email' => 'required|max:100',
        'msg' =>'required|min:10',
        'name' =>'required',
        'topic' =>'required',
      ]);


      $Review = new Contact();  //модель закидываем в переменную
      $email = $Review->email = $request->input('email');  //внутрь переменной передаем поля , которые должны быть записаны из request
      $msg = $Review->message = $request->input('msg');  //Обращаеся к переменной внутри образца класса через ->
      $name = $Review->name = $request->input('name')   ;// Знак доллара не пишется
      $topic = $Review->topic = $request->input('topic');  // То же самое,что и в Django : Review.topic


      if (Contact::where('email', $email)->first()){    //Если пользователь с таким email существует
          $userReviewDate = new DateTime((string) Contact::where('email',$email)->latest()->value('created_at'));   //То берем последнюю дату его оразения
          $nowDate = new DateTime();    //Заводим переменную с текущим временем
          $diffInHours = $userReviewDate->diff($nowDate);    // сравниваем их по датам
          if(($diffInHours->days * 24) + $diffInHours->h <= 24){   //Если дни отличаются больше,чем на день и час меньше, чем разница часов
              return redirect('/')->with('timeerror', 'Вы уже отправляли сообщение.Обратитесь позднее');
          }
        }

      $Review->save();
      return $this->takeParamsForMail($name, $email, $topic, $msg);
    }
}
