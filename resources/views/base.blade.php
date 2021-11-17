<!DOCTYPE html>
<html>
 <head>
   <title>@yield('title')</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="/css/app.css">
 </head>
<body>
  <header class="d-flex justify-content-center py-3">
    <ul class="nav nav-pills">
      <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Главная</a></li>
      <li class="nav-item"><a href="/reviews" class="nav-link">Все отзывы</a></li>
    </ul>
  </header>
  @include('messages')
  <div class="container">
    @yield('main_content')
  </div>
</body>
<html>
