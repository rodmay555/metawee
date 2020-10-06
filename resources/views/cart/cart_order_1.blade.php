@extends('layouts.app')

@section('content')


        <div class="content-hecrd-cart">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        @endif
            @if(Session()->has('add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session()->get('add')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            @if(Session()->has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{Session()->get('warning')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

            <form method="POST" action="/order_pay/" >
                @csrf
                    <div class="opp">การสั่งซื้อ</div>
                    <div class="content_pay">


                        <div class="form-group h-pay0">
                            <label for="price_pay" class="pay_image">ที่อยู่</label>

                            <div class="form-group row">
                                <label for="name" class="col_order3 col-form-label text-md-right">ชื่อ-นามสกุล</label>

                                <div class="row-input">
                                    <input id="firstname" type="text" readonly class="form-control input-1 @error('firstname') is-invalid @enderror" name="firstname" value="{{Auth::user()->firstname}}" placeholder="ชื่อ" required autocomplete="firstname" >
                                    <input id="lastname" type="text"  readonly class="form-control input-2 @error('lastname') is-invalid @enderror" name="lastname" value="{{Auth::user()->lastname}}" placeholder="นามสกุล" required autocomplete="lastname" >
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                                </div>


                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col_order3 col-form-label text-md-right">เบอร์โทร</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="phone_number"  readonly class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{Auth::user()->phone_number}}" placeholder="เบอร์โทร"  required autocomplete="phone_number">

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                        <textarea id="address"  class="form-control textarea" name="address" placeholder="ที่อยู่..."  readonly  >{{$address}}</textarea>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary btn-h0" data-toggle="modal" data-target="#editaddress">
                                เปลี่ยนที่อยู่
                            </button>




                        </div>

                        {{-- <div class="price_pay"><p class="titprice_y">ยอดรวมสินค้า : </p><p class="price_y">฿<span id="price_All_pay">500</span></p></div> --}}






                    </div>



                    <div class="content-order3">
                        <div class="content-order-list">
                        <div class="lisr-order">
                            <div class="list-item">
                                <p class="num-order">ลำดับที่</p>
                                <p class="img-order-o">รูปภาพ</p>
                                <p>สินค้า</p>
                                <p class="num-order">จำนวน</p>
                                <p class="num-order">ราคา</p>
                                <p class="num-order">ราคารวม</p>

                            </div>

                        </div>

                        <?php
                            $i = 1;
                            $price_all = 0;
                        ?>


                        @foreach($cart as $cat)
                        <div class="lisr-order">
                            <div class="list-item">
                                <p class="num-order">{{$i}}</p>
                                <p><img class="img-edit" src="{{ asset('storage') }}/product_image/{{$cat->product->image}}" alt="" width="70px" height="70px" ></p>
                                <p>{{Str::limit($cat->product->name,32)}}</p>
                                <p class="num-order">{{$cat->number}}</p>
                                <p class="num-order">{{$cat->product->price}}</p>
                                <p class="num-order">{{$cat->number*$cat->product->price}}</p>

                            </div>

                        </div>

                        <?php
                            $i += 1;
                            $price_all += $cat->number*$cat->product->price;
                        ?>
                        @endforeach




                    </div>
                    <div class="footer-order1">
                        <div class="input-group input-margin-t">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="inputGroupSelect01">บริษัทการจัดส่ง</label>
                            </div>
                            <select name="select" class="custom-select" id="inputGroupSelect01" onchange="showUser(this.value)" required>

                              <option value="{{$delivery_rate[0]->id}}" >EMS - บริษัท ไปรษณีย์ไทย ค่าส่ง  {{$delivery_rate[0]->price_rates}} บาท</option>
                              <option value="{{$delivery_rate[1]->id}} " >Kerry - เคอรี่ เอ็กซ์เพรส ค่าส่ง {{$delivery_rate[1]->price_rates}} บาท</option>


                            </select>
                          </div>
                        <div class="priceall-order-footer">

                        <div class="price_net1">

                            <div class="price_row">

                              <div class="price_com2"><span class="compop2">ยอดรวมสินค้า : </span><span class="com_o1">฿{{$price_all}}</span></div>
                              <div class="price_com2"><span class="compop2">ราคาค่าส่ง: </span> </span><span class="com_o2">฿<span id="com_oo">{{$delivery_rate[0]->price_rates}}</span></span></div>
                              <div class="price_com2"><span class="compop2">ยอดรวมทั้งหมด : </span><span id= "com3" class="com4">฿{{$price_all+$delivery_rate[0]->price_rates}}</span></div>

                            </div>

                        </div>
                     </div>
                     <button type="button" class="btn btn-primary btn-pay1" data-toggle="modal" data-target="#pay">
                        สั่งสินค้า
                    </button>
                    </div>
                </div>

                                    <!-- Button trigger modal -->


                                    <!-- Modal -->
                                    <div class="modal fade" id="pay" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>

                                            <div class="modal-body">

                                                    <h2 class="del">ต้องการยืนยันสั่งสินค้านี้ไหม</h2>


                                            </div>
                                            <div class="modal-footer">

                                                <button type="submit" class="btn btn-primary ">ยืนยัน</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                            </div>

                                        </div>
                                        </div>
                                    </div>


                        {{-- endmodal --}}


         </div>
        </form>

         <!-- Modal -->
         <div class="modal fade" id="editaddress" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">แก้ไขที่อยู่</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <div class="modal-body">


                        <div class="form-group row">
                            <label for="name" class="col_order3 col-form-label text-md-right">ชื่อ-นามสกุล</label>

                            <div class="row-input">
                                <input id="firstname1" type="text"  class="form-control input-1 @error('firstname') is-invalid @enderror" name="firstname" value="{{Auth::user()->firstname}}" placeholder="ชื่อ" required autocomplete="firstname" >
                                <input id="lastname1" type="text"   class="form-control input-2 @error('lastname') is-invalid @enderror" name="lastname" value="{{Auth::user()->lastname}}" placeholder="นามสกุล" required autocomplete="lastname" >
                                @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                            </div>


                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col_order3 col-form-label text-md-right">เบอร์โทร</label>

                            <div class="col-md-6">
                                <input id="phone_number1" type="phone_number"   class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{Auth::user()->phone_number}}" placeholder="เบอร์โทร"  required autocomplete="phone_number">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    <div class="form-group">
                        <label for="price_pay" class="pay_image">ที่อยู่</label>


                    <textarea id="address1"  class="form-control textarea" name="address" placeholder="ที่อยู่..." >{{$address}}</textarea>





                    </div>


                </div>
                <div class="modal-footer">

                    <button onclick="update_addreess()" class="btn btn-primary ">ตกลง</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>

            </div>
            </div>
        </div>

        <?php
        $delivery_rate1= $delivery_rate[0]->price_rates;
        $delivery_rate2= $delivery_rate[1]->price_rates;

        ?>

        {{-- endmodal --}}
                    <script>



        function showUser(str) {

            if(str == 1){
                document.getElementById("com_oo").innerHTML = {{$delivery_rate1}};
               document.getElementById("com3").innerHTML = {{$price_all+$delivery_rate1}};

            }else if(str == 2){
                document.getElementById("com_oo").innerHTML = {{$delivery_rate2}};
              document.getElementById("com3").innerHTML = {{ $price_all+$delivery_rate2 }} ;

            }

        }

        function update_addreess(){
            let firstname1 = document.getElementById("firstname1").value;
            let lastname1 = document.getElementById("lastname1").value;
            let phone_number1 = document.getElementById("phone_number1").value;
            let address1 = document.getElementById("address1").value ;



            document.getElementById("firstname").value = firstname1;
           document.getElementById("lastname").value = lastname1;
           document.getElementById("phone_number").value = phone_number1;
           document.getElementById("address").value  = address1;
            $('#editaddress').modal('hide');

        }

        document.getElementById("number_All").innerHTML = {{$numberAll}} ;
                    </script>



                    @endsection



