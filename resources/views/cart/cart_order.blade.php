@extends('layouts.app')

@section('content')


        <div class="content-hecrd-cart">

            @if(Session()->has('add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session()->get('add')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
                <div class="tit-cart">




                    @if($cart->count()==0)
                    <div class="opp">ตระกร้าสินค้า</div></div>
                    <div class="content-item-cart">

                        <div class="alert alert-warning not-cart" role="alert">
                            ไม่มีสินค้าในตระกร้าสินค้า
                          </div>

                    </div>
                    <script>
                        document.getElementById("number_All").innerHTML = 0 ;
                    </script>
                    @else
                        <div class="opp">ตระกร้าสินค้า</div>
                            <div class="item-tit padding-tit">รายละเอียดสินค้า</div>
                            <div class="item-tit padding-tit">สินค้าคงเหลือ</div>
                            <div class="item-tit padding-tit">จำนวน</div>
                            <div class="item-tit padding-tit">ราคา</div>
                            <div class="item-tit padding-tit">ราคารวม</div>




                    </div>





                <div class="content-item-cart">


                            <table class="table">
                                <tbody>
                                    <?php
                                        $number_All = 0;
                                        $price_All = 0;
                                        ?>
                                    @foreach($cart as $car)
                                        @foreach($product as $pro)
                                        @if($pro->id == $car->product_id)
                                        <?php
                                            $number_All += $car->number;
                                            $price_All += $pro->price*$car->number;
                                        ?>
                                  <tr>
                                    <td class="td-cart"><img class="img-edit" src="{{ asset('storage') }}/product_image/{{ $pro->image }}" alt="" width="100px" height="100px" ></td>
                                    <td class="center name-cart">{{Str::limit($pro->name,25)}}</td>
                                    <td class="detail-cart">{{ Str::limit($pro->description,25) }}</td>
                                    <td class="">{{ $pro->number_product }}</td>

                                    <td class="center prie-cart"><div class="rowbtn"> <a class="btn btn-light" onclick="increm({{$pro->id}})">+</a><input id="cart_number{{$pro->id}}" class="tes-cart text_number" value="{{$car->number}}" onchange="cartNumber({{$pro->id}})"> <a class="btn btn-light" onclick="decrem({{$pro->id}})">-</a></div></td>
                                    <td class="center">{{$pro->price}}</td>
                                    <td id="total_price{{$pro->id}}" class="center total_price_order">{{$pro->price*$car->number}}</td>
                                    <td class="center">


                                         {{-- modal ลบสินค้า --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn_dan_order" data-toggle="modal" data-target="#delcart{{$car->id}}">
                                        <i class="far fa-trash-alt"></i> ลบสินค้า
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delcart{{$car->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>

                                            <div class="modal-body">

                                                    <h2 class="del">ต้องการลบข้อมูลนี้ไหม</h2>


                                            </div>
                                            <div class="modal-footer">

                                            <a href="/del_cart/{{$car->id}}" class="btn btn-danger">ลบข้อมูล</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                            </div>

                                        </div>
                                        </div>
                                    </div>


                        {{-- endmodal --}}
                                    </td>

                                  </tr>
                                        @endif
                                        @endforeach
                                  @endforeach
                                </tbody>
                              </table>
                              <div class="total-cart">
                                  {{-- <div class="numder-cart"><p>จำนวนทั้งหมด:</p> <p  id="cart_number_All" class="number-cc">{{$number_All}}</p></div> --}}
                                  <div class="numder-cart"><p>ราคารวมสุทธิ:</p> <p id="total_price_All" class="tatolp-cc">{{number_format($price_All)}} บาท</p></div>




                            </div>
                            <a  href="/cart_order" class="btn btn-success btn-cartpp">สั่งซื้อ</a>
                            <a  href="/" class="btn btn-primary btn-cartpp">ต้องการซื้อสินค้าเพิ่ม</a>
                        </div>

                    </div>

                    <script>
                        document.getElementById("number_All").innerHTML = {{$number_All}} ;
                    </script>
                    @endif
                    @endsection
