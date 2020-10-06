@extends('layouts.app')

@section('content')

        <div class="content-category">
            <div class="opp">รายละเอียดสินค้า</div>

            <div class="detail_pro">


                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class=""> <img class="img-detail" src="{{ asset('storage') }}/product_image/{{ $product->image }}" alt=""  ></div>
                      </div>
                      @if($product->image2)
                      <div class="carousel-item">
                        <div class=""> <img class="img-detail" src="{{ asset('storage') }}/product_image/{{ $product->image2 }}" alt=""  ></div>
                      </div>
                      @endif
                      @if($product->image3)
                      <div class="carousel-item">
                        <div class=""> <img class="img-detail" src="{{ asset('storage') }}/product_image/{{ $product->image3 }}" alt=""  ></div>
                      </div>
                      @endif
                      @if($product->image4)
                      <div class="carousel-item">
                        <div class=""> <img class="img-detail" src="{{ asset('storage') }}/product_image/{{ $product->image3 }}" alt=""  ></div>
                      </div>
                      @endif
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                <div class="detail_pro2">
                    <p class="name_product">{{$product->name}}</p>
                    <span class="detail_product">รายละเอียดสินค้า</span>
                    <p> {{$product->description}}</p>
                    <span class="category_product">หมวดสิค้า</span>
                    <p>{{$product->category->name}}</p>

                    <span class="category_product">สินค้าคงเหลือ</span>
                    <p>{{$product->number_product}}</p>

                    <p class="price_product">฿{{$product->price}}</p>
                    @if(Auth::check())
                           <a class="btn btn-primary btn-cart " href="/cart_app/{{$product->id}}"> เพิ่มสินค้า</a>
                           @else
                           <a class="btn btn-primary btn-cart " href="/login"> เพิ่มสินค้า</a>
                           @endif

                </div>
            </div>
    </div>

    @if(Auth::check())
    <script>
        document.getElementById("number_All").innerHTML = {{$numberAll}} ;
    </script>
    @endif
@endsection
