<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<header class="d-flex justify-content-center py-3">
    <title>@yield('title')</title>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Главная</a></li>
        <li class="nav-item"><a href="/reviews" class="nav-link">Все отзывы</a></li>
      </ul>
    </header>
<div>
  <body>
      @include('messages')
      <div class="container">
        @yield('main_content')
    <div>
  </body>
