@extends('base')
@section('title')
  Главная
@endsection('title')
@section('main_content')
  <h1>Форма добавления отзыва </h1>
  <br>
    <form method="post" action="send-mail">
        @csrf
        <input type="email" name="email" id="email" placeholder="Введите email" class="form-control"><br>
        <input type="text" name="topic" id="topic" placeholder="Введите тему" class="form-control"><br>
        <input type="text" name="name" id="name" placeholder="Введите имя" class="form-control"><br>
        <textarea name="msg" id="msg" placeholder="Опишите проблему" class="form-control"></textarea><br>
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>
@endsection
