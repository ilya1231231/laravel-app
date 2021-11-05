<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Contact;




class MainController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function showAllReviews()
    {
        $Reviews = new Contact();
        return view('allforms', ['reviews'=> $Reviews->all()]);   //Передаем контекстную переменную в шаблон пот именем 'reviews'
    }

}
