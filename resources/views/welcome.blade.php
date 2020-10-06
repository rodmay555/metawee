@extends('layouts.app')

@section('content')

        <div class="content-category">
                <div class="opp">หมวดสินค้า</div>
                <div class="grid-category">
                    <a href="/">ทั้งหมด</a>
                    @foreach($category as $cat)
                    <a href="/category{{$cat->id}}">{{$cat->name}}</a>
                    @endforeach
                </div>
            </div>





        <div class="content-hecrd">
                <div class="opp">สินค้า</div>
                <div class="search-wel">
                    <form method="GET" action="/" class="form-search">
                        <input class="form-control search-input" type="search" placeholder="ค้นหา" aria-label="Search" name='search'>
                        <button  class="btn btn-outline-primary btn-search" type="submit"> ค้นหา</button>
                      </form>
                </div>

        </div>
          <div class="container_welcome">


                @foreach($product as $pro)

                    @if($pro->number_product != 0)
                    <div class="card-welcome">
                        <div class="img-g"><img class="img-welcome" src="{{ asset('storage') }}/product_image/{{ $pro->image }}" alt="Denim Jeans" ></div>

                    <h5>สินค้า: <span class="h5">{{Str::limit($pro->name,14)}}</span></h5>
                    <p class="price"><strong>ราคา: </strong>฿{{$pro->price}}</p>
                        <p><strong>หมวด: </strong> {{$pro->category->name}}</p>


                        <div class="welcome-btn-cart">
                            @if(Auth::check())
                           <a class="btn btn-primary btn-cart" href="/cart_app/{{$pro->id}}"> เพิ่มสินค้า</a>
                           @else
                           <a class="btn btn-primary btn-cart" href="/login"> เพิ่มสินค้า</a>
                           @endif
                           <a class="btn btn-secondary btn-cart" href="/product/{{$pro->id}}"> รายละเอียด</a>
                        </div>

                      </div>
                @endif

                @endforeach



          </div>

          <div class="content-hecrd">
            {{ $product->links() }}



    </div>

    @if(Auth::check())
    <script>
        document.getElementById("number_All").innerHTML = {{$numberAll}} ;
    </script>
    @endif
@endsection
