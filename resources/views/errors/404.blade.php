@auth
    @extends('layouts.app')

    @section('title', 'Ошибка 404')

    @section('content')
        <div class="container-fluid">

            <!-- 404 Error Text -->
            <div class="text-center">
                <div class="error mx-auto" data-text="404">404</div>
                <p class="lead text-gray-800 mb-5">Страница не найдена!</p>
                <p class="text-gray-500 mb-0">Вы пытаетесь загрузить не существующую страницу!</p>
                <a href="{{route('home')}}">← Вернуться на Главную</a>
            </div>

        </div>
    @endsection
@endauth
