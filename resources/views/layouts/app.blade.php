<html>
<head>
    <title>App Name - @yield('title')</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
    integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
    integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('public/css/general.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 side-navbar">
                <ul class="list-group">
                    <li class="list-group-item {{ Request::is('/') ? 'active_nav' : '' }}">
                        <a class="nav-link " href="/"><i
                            class="fas fa-home"></i>Записи</a>
                        </li>
                        <li class="list-group-item {{ Request::is('teacher') ? 'active_nav' : '' }}">
                            <a class="nav-link " href="/teacher"><i
                                class="fas fa-users"></i>Преподаватели</a>
                            </li>
                            <li class="list-group-item {{ Request::is('discipline') ? 'active_nav' : '' }}">
                                <a class="nav-link " href="/discipline"><i
                                    class="fas fa-book"></i>Дисциплины</a>
                                </li>
                                <li class="list-group-item {{ Request::is('group') ? 'active_nav' : '' }}">
                                    <a class="nav-link " href="/group"><i
                                        class="fas fa-child"></i>Группы</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-10 side-main">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-12">
                                            <!-- Отображение ошибок проверки ввода -->
                                            @include('layouts.errors')
                                        </div>
                                    </div>
                                </div>
                                
                                @yield('content')
                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                    crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
                    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
                    crossorigin="anonymous"></script>
                    <script src="{{ URL::asset('public/js/general.js') }}"></script>

                </body>
                </html>