<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;




Route::get('/', "MainController@home");   //1)Ссылка по которой доступен шаблон 2)Метод, вызываемый из контроллера

Route::get('/reviews', "MainController@showAllReviews")->name('reviews');  //То же самое,в конце добавляем имя



//Обрабатываются данные из формы и функция отправки отзыва от человека к админу
Route::post('send-mail', 'MailSettingController@sendRiview');

Route::post('/reviews/{statusId}/send-answer', "MainController@sendReplyToRiview")->name('status.reply');






















Route::get('/1', function (){
    $contacts = \App\Models\Contact::all(); // забираем все обекты из БД
    foreach($contacts as $el){  //ПРоходим циклом
        echo 'eamil отправителя: '.$el['email'];  //обращаемся к колонке из бд
        echo 'Ваш ответ: '.$el->gimmeAnswer['text'];  //обращаемся к методу из модели "КОНТАКТ"
    }
});
