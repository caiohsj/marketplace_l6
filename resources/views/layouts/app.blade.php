<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            @auth
              <li class="nav-item">
                <a class="nav-link @if (request()->is('admin/stores')) active @endif" href="{{route('admin.stores.index')}}">Lojas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link @if (request()->is('admin/products')) active @endif" href="{{route('admin.products.index')}}">Produtos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link @if (request()->is('admin/categories')) active @endif" href="{{route('admin.categories.index')}}">Categorias</a>
              </li>
            @endauth
          </ul>
          @auth
            <form action="{{route('logout')}}" class="form-inline my-2 my-lg-0" method="POST">
              @csrf
              <button class="btn btn-link my-2 my-sm-0" type="submit">Sair</button>
            </form>
          @endauth
        </div>
      </nav>
    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
</body>
</html>