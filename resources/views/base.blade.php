<!DOCTYPE html>
<html>
 <head>
   <title>@yield('title')</title>
   <meta charset="utf-8">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
