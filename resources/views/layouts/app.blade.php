<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ผลิตภัณฑ์ชาเมี่ยง</title>

        {{-- bootstrap 4 --}}
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}}">
        {{-- <script src="{{ asset('js/jquery.min.js') }}" defer></script> --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{ asset('js/popper.min.js') }}" defer></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
        {{-- end bootstrap 4 --}}




    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">


    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Styles -->

     <link rel="stylesheet" href="{{ asset('/css/project.css')}}">
     <script src="{{ asset('js/project.js') }}" defer></script>



</head>
<body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light move-nav">
            <a class="navbar-brand" href="/">ผลิตภัณฑ์ชาเมี่ยง</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">


            <ul class="navbar-nav ml-auto">

                <li class="nav-item ">
                    <a class="nav-link" href="/"> หน้าแรก <span class="sr-only">(current)</span></a>
                  </li>




                    @if (Route::has('login'))

                        @auth
                        <li class="nav-item ">
                            <a class="nav-link" href="/cart"> ตระกร้าสินค้า (<span id="number_All"></span>)</a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{auth::user()->name}}
                              </a>

                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/home') }}">ข้อมูลส่วนตัว</a>
                                <a class="dropdown-item" href="/order">รายการสั่งซื้อ</a>
                                @if(Auth::user()->status == 2)<a class="dropdown-item" href="/admin/product">admin</a>@endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">ออกจากระบบ</a>
                              </div>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @else
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('login') }}">เข้าสู่ระบบ</a>
                        </li>

                            @if (Route::has('register'))
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('register') }}">สมัครสมาชิก</a>
                            </li>
                            @endif
                        @endauth

              </ul>
          @endif
            </div>
          </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
