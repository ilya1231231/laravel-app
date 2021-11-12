@extends('base')
@section('title')
  Все отзывы
@endsection('title')
@section('main_content')
  <h1>Все отзывы </h1>
  <br>
  @foreach($reviews as $el)
    <div class="alert alert-warning">
        <p>Email: {{ $el->email }}</p>
        <p>Тема: {{ $el->topic }}</p>
        <p>Имя: {{ $el->name }}</p>
        <p>Сообщение: {{ $el->message }}</p>
          @if ($el->giveMeAnswer)
              <h3>Вы ответили на это сообщение</h3>
          @else
              <form method="post" action="{{ route('status.reply',  ['statusId' => $el->id])}}">
                  @csrf
                  <textarea name="text-{{ $el->id }}" id="text" placeholder="Ответить на сообщение" class="form-control"></textarea>
                  <button type="submit" class="mt-3 btn btn-success">Ответить</button>
              </form>

          @endif
    </div>
  @endforeach
@endsection
