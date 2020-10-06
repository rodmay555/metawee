@extends('layouts.app')

@section('content')

<script src="{{ asset('js/fontwee.js') }}" defer></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

        <div class="content-hecrd-cart">

            @if(Session()->has('add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session()->get('add')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif





                        <div class="opp nnorder">รายการสั่งซื้อสินค้า</div>

                        <form method="get" action="/order">
                            <div class="row-pp with-date">

                                <div class="form-group">
                                <div class="input-group date date_order1" id="datetimepicker7" data-target-input="nearest">
                                     <input type="text" class="form-control datetimepicker-input" name="date1" data-target="#datetimepicker7" required/>
                                     <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                         <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                     </div>
                                 </div>
                             </div> <span class="span-pp">ถึง</span>   <div class="form-group">
                                <div class="input-group date date_order2" id="datetimepicker8" data-target-input="nearest">
                                     <input type="text" class="form-control datetimepicker-input" name="date2" data-target="#datetimepicker8" required/>
                                     <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                                         <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                     </div>
                                 </div>
                             </div> <button type="submit" class="btn btn-info wbtn">ค้นหา</button></div>
                            </form>

                            <div class="grid-category1">
                                <a href="/order">ทั้งหมด</a>

                                @foreach($status as $statu)
                                <a href="/order/{{$statu->id}}">{{$statu->name}}</a>
                                @endforeach

                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker7').datetimepicker({
                                        format: 'DD/MM/YYYY'
                                    });
                                    $('#datetimepicker8').datetimepicker({
                                        useCurrent: false,
                                        format: 'DD/MM/YYYY'
                                    });
                                    $("#datetimepicker7").on("change.datetimepicker", function (e) {
                                        $('#datetimepicker8').datetimepicker('minDate', e.date);
                                    });
                                    $("#datetimepicker8").on("change.datetimepicker", function (e) {
                                        $('#datetimepicker7').datetimepicker('maxDate', e.date);
                                    });
                                });
                            </script>









                <div class="content-item-cart">

                        @foreach($order_herd as $herd)
                        <?php
                            $i[$herd->id] = 1;
                            $number_all_order[$herd->id] = 0;
                            $price_all_order[$herd->id] = 0;


                        ?>
                        <div class="content-order">
                                <div class="hard-order">
                                    <div class="hard-ti num-order1" ><p>หมายเลขการสั่งซื้อ</p><span class="color-s">{{$herd->number_order}}</span></div>
                                    <div class="hard-ti num-order"><p>สถานะ</p><span class="color-t">{{$herd->status_na['name']}}</span></div>




                                    <div class="hard-ti num-order"> <p>วันที่</p><span>{{date("d/m/Y H:i:s", strtotime($herd->created_at))}}</span></div>

                                   @if($herd->status > 1 && $herd->status <6) <a href="/receipt/{{$herd->number_order}}" target="_blank" class="btn2  btn-receipt">พิมพ์ใบเสร็จ</a> @endif


                                </div>
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
                                @foreach($herd->order_list as $list)

                                <div class="lisr-order">
                                    <div class="list-item">
                                        <p class="num-order">{{$i[$herd->id]}}</p>
                                        <p><img class="img-edit" src="{{ asset('storage') }}/product_image/{{ $list->product->image }}" alt="" width="70px" height="70px" ></p>
                                        <p>{{Str::limit($list->product->name,32)}}</p>
                                        <p class="num-order">{{$list->number}}</p>
                                        <p class="num-order">{{$list->product->price}}</p>
                                        <p class="num-order">{{$list->number*$list->product->price}}</p>

                                    </div>

                                </div>

                                <?php
                                    $i[$herd->id] += 1;
                                    $number_all_order[$herd->id] += $list->number;
                                    $price_all_order[$herd->id] += $list->number*$list->product->price;
                            ?>

                                @endforeach
                            </div>
                            <div class="footer-order">
                                <div class="priceall-order-footer">
                                    @if($herd->status == 1)
                                    <div class="priceall-3" >ชำระเงินก่อนวันที่ <br>{{date("d/m/Y H:i:s", strtotime($herd->deadline_pay))}}</div>
                                    @endif
                                    @if($herd->status == 6)
                                    <div class="priceall-3" >ชำระเงินก่อนวันที่ <br>{{date("d/m/Y H:i:s", strtotime($herd->deadline_pay))}}</div>
                                    @endif
                                    @if($herd->status >= 3 && $herd->status < 6)
                                    <div class="priceall-3" >เลขติดตามพัสดุ {{$herd->delivery->delivery_rate_d->company}} : <span class="color-a">{{$herd->delivery->tracking}}</span></div>
                                    @elseif($herd->status == 2)
                                    <div class="priceall-3" >เลขติดตามพัสดุ : <span class="color-a">-</span></div>
                                    @endif
                                    @if($herd->status == 1) <div class="priceall-4">
                                        <a  href="/cart_pay/{{$herd->number_order}}" class="btn btn-primary btn-product1" >ชำระเงิน</a>
                                        <p   class="btn btn-danger btn-product1 " data-toggle="modal" data-target="#delete{{$herd->id}}">ยกเลิกการสั่งสินค้า</p>

                                        <div class="modal fade" id="delete{{$herd->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>

                                                <div class="modal-body">

                                                        <h2 class="del">ต้องการยกเลิกการสั่งสินค้า</h2>


                                                </div>
                                                <div class="modal-footer">

                                                <a href="/order/delete/{{$herd->number_order}}" class="btn btn-danger">ตกลง</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                </div>

                                            </div>
                                            </div>
                                        </div>

                                    </div>
                                    @endif
                                    @if($herd->status == 4) <p  class="btn btn-primary btn-product priceall-4 " data-toggle="modal" data-target="#status{{$herd->id}}">ยืนยันได้รับสินค้าแล้ว</p> @endif
                                    @if($herd->status == 5) <p  class="btn1 btn-outline-success1 btn-product priceall-4">สำเร็จแล้ว</p> @endif


                                    <div class="modal fade" id="status{{$herd->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>

                                            <div class="modal-body">

                                                    <h2 class="del">ยืนยันฉันได้รับสินค้าแล้ว</h2>


                                            </div>
                                            <div class="modal-footer">

                                            <a href="/order/received/{{$herd->number_order}}" class="btn btn-primary">ตกลง</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                            </div>

                                        </div>
                                        </div>
                                    </div>


                                    <div class="price_net1">
                                        <div class="price_row">
                                            @if($herd->delivery['delivery_rate'] == 1)
                                          <div class="price_com1"><span>ราคาค่าส่ง {{$herd->delivery->delivery_rate_d->company}} : </span><span class="com1">฿{{$herd->delivery->delivery_rate_d->price_rates}}</span></div>
                                          @elseif($herd->delivery['delivery_rate'] == 2)
                                          <div class="price_com1"><span>ราคาค่าส่ง {{$herd->delivery->delivery_rate_d->company}} : </span><span class="com3">฿{{$herd->delivery->delivery_rate_d->price_rates}}</span></div>
                                          @endif
                                          <div class="price_com2"><span class="compop2">ราคารวมทั้งหมด : </span><span class="com2">฿{{$herd->pay['price_net']}}</span></div>

                                        </div>

                                    </div>


                            </div>

                             </div>
                        </div>
                        @endforeach
                        {{ $order_herd->links() }}
                    </div>

                    <script>
                        document.getElementById("number_All").innerHTML = {{$numberAll}} ;
                    </script>

                    @endsection
