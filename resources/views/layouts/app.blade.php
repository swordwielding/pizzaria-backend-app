<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Pizza</title>

    @vite('resources/css/product-form.css')
    @vite('resources/css/global.css')
    @vite('resources/css/products.css')

</head>
<body>
    @php
        use Illuminate\Support\Facades\Storage;
        use Illuminate\Support\Str;
    @endphp
    <nav>
        @auth
            <a href="{{ route('products.index')}}">Главная</a>
            <a href="{{ route('products.create')}}">Создать</a>
            
            <span>{{ Auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Выйти</button>
            </form>
        @endauth
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>