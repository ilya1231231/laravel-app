<?php
// declare(strict_types=1);
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use App\Http\Requests\ContactRequest;
class Contact extends Model
{
    use HasFactory;
    public $request;

    //получаем обдин объект через Contact
    public function gimmeAnswer(){
        return $this->hasOne(Answer::class);
    }

    //ищем emal в БД
    public function findEmail($email){
        return $this::where('email', $email)->first();
    }

    //получаем последнуу значение даты отзыва,если он найден
    public function getLatestEmailsDate($email){
      return $this::where('email',$email)->latest()->value('created_at');
    }

    //проверяем Email пользователя
    public function checkEmailTime($email){

      if ($this->findEmail($email)){    //Если пользователь с таким email существует
          $userReviewDate = new DateTime((string) ($this->getLatestEmailsDate($email)));   //То берем последнюю дату его оразения
          $nowDate = new DateTime();    //Заводим переменную с текущим временем
          $diffInHours = $userReviewDate->diff($nowDate);    // сравниваем их по датам
          if(($diffInHours->days * 24) + $diffInHours->h <= 24){    //получаем разницу дат в часах и сравниваем
              return false;
          }
        }
          return true;
    }

    //Показать сообщение об успешной отправке
    public function redirectToWithSuccess(){
      return redirect('/')->with('success', 'Сообщение отпрвалено');
    }

    //показать сообщение об обшибке
    public function redirectToWithError(){
      return redirect('/')->with('timeerror', 'Вы уже отправлли сообщение');
    }

    //функция сохранения данных формы при успешной проверке
    public function saveMessage($email){
    if($this->checkEmailTime($email)){
          $this->save();
          $this->redirectToWithSuccess();
        }else{
    $this->redirectToWithError();
    }
    }

    //функция принятия данных
    public function takeData($request){

      $email = $this->email = $request->email;
      $msg  = $this->message = $request->msg;
      $name = $this->name = $request->name;
      $topic = $this-> topic = $request->topic;
      $this->saveMessage($email);

    }

}
