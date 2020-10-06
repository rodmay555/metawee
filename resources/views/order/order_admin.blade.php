@extends('layouts.admin2')

@section('content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
{{-- <script src="https://kit.fontawesome.com/632cf620c0.js" crossorigin="anonymous"></script> --}}

<div class="container-admin">
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


    <div class="heard">

    <h2 class="h2">รายการสั่งซื้อของสมาชิก</h2>
    <form method="get" action="/admin/order">
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

    <div class="grid-category">
        <a href="/admin/order">ทั้งหมด</a>

        @foreach($status as $statu)
        <a href="/admin/order/status/{{$statu->id}}">{{$statu->name}}</a>
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




        </div>

        <table class="table order-admin-table">
            <thead>
              <tr>
                <th scope="col">หมายเลขการสั่งซื้อ</th>
                <th scope="col">รูปภาพหลักฐานการโอน</th>
                <th scope="col">ข้อมูลการจัดส่ง</th>
                <th scope="col">สมาชิก</th>
                <th scope="col">สถานะ</th>
                <th scope="col">วันที่</th>
                <th scope="col">จัดการ</th>
              </tr>
            </thead>
            <tbody>
              <tr>

                  @foreach($order_herd as $herd)
                  <?php
                  $i[$herd->id] = 1;
                  $number_all_order[$herd->id] = 0;
                  $price_all_order[$herd->id] = 0;
          ?>
                <th><a class="number_order_ta" href=# data-toggle="modal" data-target="#fa{{$herd->number_order}}">{{$herd->number_order}}</a></th>

                            <!-- Modal -->
                            <div class="modal fade " id="fa{{$herd->number_order}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-with" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"><span> หมายเลขการสั่งซื้อ : <span class="num-oredii">{{$herd->number_order}}</span> </span>     </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="content-order2">
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
                                                    <p><img class="img-edit" src="{{ asset('storage') }}/product_image/{{$list->product->image}}" alt="" width="70px" height="70px" ></p>
                                                    <p>{{Str::limit($list->product->name,32)}}</p>
                                                    <p class="num-order">{{$list->number}}</p>
                                                    <p class="num-order">{{$list->product->price}}</p>
                                                    <p class="num-order">{{$list->number*$list->product->price}}</p>
                                                </div>

                                            </div>

                                            <?php
                                            $i[$herd->id] += 1;
                                            $number_all_order[$herd->id] += $list->number;
                                            $price_all_order[$herd->id] +=$list->number*$list->product->price;
                                    ?>
                                            @endforeach

                                        </div>
                                        <div class="footer-order">
                                            <div class="priceall-order-footer">
                                            <div class="price_net1">
                                                <div class="price_row">
                                                    @if($herd->delivery['delivery_rate'] == 1)
                                                  <div class="price_com1"><span>ราคาค่าส่ง {{$herd->delivery['delivery_rate_d']['company']}} : </span><span class="com1">฿{{$herd->delivery->delivery_rate_d->price_rates}}</span></div>
                                                  @elseif($herd->delivery['delivery_rate'] == 2)
                                                  <div class="price_com1"><span>ราคาค่าส่ง {{$herd->delivery['delivery_rate_d']['company']}} : </span><span class="com3">฿{{$herd->delivery->delivery_rate_d->price_rates}}</span></div>
                                                  @endif
                                                  <div class="price_com2"><span class="compop2">ราคารวมทั้งหมด : </span><span class="com2">฿{{$herd->pay['price_net']}}</span></div>

                                                </div>

                                            </div>
                                         </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">


                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                    </div>

                                </div>
                                </div>
                            </div>






                <td><a class="a-img" href="#" data-toggle="modal" data-target="#imageO{{$herd->number_order}}">รูปภาพหลักฐาน</a></td>


                <div class="modal fade " id="imageO{{$herd->number_order}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-with-img" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">รูปภาพหลักฐาน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="modal-body">

                            <img class="img-edit1" src="{{ asset('storage') }}/Order_image/{{$herd->pay['image_pay']}}" alt="" >
                        </div>
                        <div class="modal-footer">


                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        </div>

                    </div>
                    </div>
                </div>



                <td><a class="a-img1" href="#" data-toggle="modal" data-target="#DeliveryO{{$herd->number_order}}">ข้อมูลการจัดส่ง</a></td>

                <div class="modal fade " id="DeliveryO{{$herd->number_order}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><span> ข้อมูลการจัดส่ง </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="modal-body">
                        <div class="name_last"><strong>ชื่อ : </strong>{{$herd->delivery['firstname']}}  <strong>นามสกุล : </strong>{{$herd->delivery['lastname']}} </div>
                            <div class="number_de"><strong>เบอร์โทร : </strong>{{$herd->delivery['phone_number']}}</div>
                            <div class="address_de"><strong>ที่อยู่ : </strong>{{$herd->delivery['address']}} </div>
                            <div class="com"><strong>บริษัทการจัดส่ง : </strong>{{$herd->delivery['delivery_rate_d']['company']}} </div>




                        </div>
                        <div class="modal-footer">
                            <div class="foealsd"><span class="tekkd">เลขติดตามพัสดุ : </span> <span class="text-tek">{{$herd->delivery['tracking']}}</span></div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        </div>

                    </div>
                    </div>
                </div>
                <td>{{$herd->user->name}}</td>
                <td>@if($herd->status <=3)<p class="status-ns2">{{$herd->status_na->name}}</p>@endif
                    @if($herd->status ==4)<p class="status-ns3">{{$herd->status_na->name}}</p>@endif
                    @if($herd->status == 5)<p class="status-ns1">{{$herd->status_na->name}}</p>@endif
                    @if($herd->status == 6)<p class="status-ns4">{{$herd->status_na->name}}</p>@endif
                </td>
                <td>{{date("d/m/Y H:i:s", strtotime($herd->created_at))}}</td>
                <td>

                    @if($herd->status == 1)

                    <p class="text-pri3">รอการชำระเงิน</p>

                @elseif($herd->status == 2)
                <button type="button" class="btn btn-primary primaig" data-toggle="modal" data-target="#prro{{$herd->number_order}}">
                    อนุมัติ
                </button>

                <div class="modal fade" id="prro{{$herd->number_order}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="modal-body">

                                <h2 class="del">ต้องการอนุมัติการสั่งซื้อนี้ไหม</h2>


                        </div>
                        <div class="modal-footer">

                            <a href="/admin/order/approve/{{$herd->number_order}}"type="button" class="btn btn-primary primaig">อนุมัติ</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        </div>

                    </div>
                    </div>
                </div>


                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#notprro{{$herd->number_order}}">
                    ไม่อนุมัติ
                </button>

                <div class="modal fade" id="notprro{{$herd->number_order}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="modal-body">

                                <h2 class="del">ไม่ต้องการอนุมัติการสั่งซื้อนี้?</h2>


                        </div>
                        <div class="modal-footer">

                            <a href="/order/delete/{{$herd->number_order}}"type="button" class="btn btn-danger primaig">ไม่อนุมัติ</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        </div>

                    </div>
                    </div>
                </div>
                @elseif($herd->status == 3)
                <button type="button" class="btn btn-primary primaig" data-toggle="modal" data-target="#prrosuccess{{$herd->number_order}}">
                    ทำการจัดส่ง
                </button>

                <div class="modal fade" id="prrosuccess{{$herd->number_order}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><span> ข้อมูลการจัดส่ง </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="/admin/order/approve/tracking/{{$herd->number_order}}">
                                @csrf
                                <div class="form-group">
                                    <label class="label_category">เลขติดตามพัสดุ</label>
                                    <input type="text" class="form-control" id="tracking"  name="tracking" required>

                                  </div>

                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">ตกลง</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
                @elseif($herd->status == 4)
                <p class="text-pri">ที่ต้องได้รับ</p>
                @elseif($herd->status == 5)
                <p class="text-pri1">สำเร็จ</p>
                @elseif($herd->status == 6)
                <p class="text-pri2">ยกเลิก</p>
            @endif




            </tr>

              @endforeach
            </tbody>
          </table>
        </div>

        </div>



@endsection
