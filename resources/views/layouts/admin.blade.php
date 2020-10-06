<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ผลิตภัณฑ์ชาเมี่ยง(admin)</title>


        {{-- bootstrap 4 --}}
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="{{ asset('js/jquery.min.js') }}" defer></script>
        {{-- <script src="{{ asset('js/popper.js') }}" defer></script> --}}
        <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
        {{-- end bootstrap 4 --}}




    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

     <link rel="stylesheet" href="../css/project.css">
     <script src="{{ asset('../js/project.js') }}" defer></script>
</head>
<body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark move-nav">
            <a class="navbar-brand" href="/">ผลิตภัณฑ์ชาเมี่ยง</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="/admin/product">สินค้า</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="/admin/category">หมวดสินค้า</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/admin/product_expire">สินค้าที่ใกล้หมด</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/admin/daily_rate">บริการจัดส่ง</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="/admin/order">รายการสั่งซื้อของสมาชิก</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="/sales_daily">ยอดการขายประจำวันเดือนปี</a>
                    </li>

                </ul>

            <ul class="navbar-nav ml-auto">



                    @if (Route::has('login'))

                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{auth::user()->name}}
                              </a>

                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/home') }}">ข้อมูลส่วนตัว</a>
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
