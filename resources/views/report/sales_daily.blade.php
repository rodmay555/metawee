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

    <h2 class="h2">ยอดการขายประจำวัน {{$time}}</h2>

    <h5 class="price_total">ยอดรวมสุทธิ :  <span class="price_total1" id="price_total2"></span> บาท</h5>
    </div>
    <form method="get" action="/sales_daily_s">
    <div class="row-pp with-date">

        <div class="form-group">
        <div class="input-group date date_order1" id="datetimepicker7" data-target-input="nearest">
             <input type="text" class="form-control datetimepicker-input" name="date1" data-target="#datetimepicker7" required/>
             <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                 <div class="input-group-text"><i class="fa fa-calendar"></i></div>
             </div>
         </div>
     </div> <span class="span-pp"></span>   <div class="form-group">
        <div class="input-group date date_order2" id="datetimepicker8" data-target-input="nearest">
             <input type="text" class="form-control datetimepicker-input" name="date2" data-target="#datetimepicker8" required/>
             <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                 <div class="input-group-text"><i class="fa fa-calendar"></i></div>
             </div>
         </div>
     </div> <button type="submit" class="btn btn-info wbtn">ค้นหา</button></div>
    </form>

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

@php
    $total_all = 0;
@endphp

<table class="table order-admin-table">
    <thead>
      <tr>
        <th scope="col">รหัส</th>
        <th scope="col">ชื่อ</th>
        <th scope="col">จำนวน</th>
        <th scope="col">ราคา</th>
        <th scope="col" class="text_ar">ราคารวม</th>

      </tr>
    </thead>
    @foreach($order_herd as $herd)
    <thead class="thard_sales">
      <tr class="head_order">
        <td scope="col">{{$herd->user->id}}</th>
        <td scope="col">ชื่อ {{$herd->user->firstname}} {{$herd->user->lastname}} <span class="number_order_o">หมายเลขการสั่งซื้อ {{$herd->number_order}}</span>
             </th>
        <td scope="col"></th>
        <td scope="col"></th>
        <td scope="col" class="text_ar">วันที่ {{$herd->created_at->isoformat('DD/MM/Y')}}</th>

      </tr>
    </thead>
    <tbody class="tbody_sales">
        @php
            $price_total = 0;
            $price_t = 0;
            $number = 0;
        @endphp

        @foreach($herd->order_list as $list)
        <tr>
        <td scope="col">{{$list->product->id}}</td>
            <td scope="col">{{Str::limit($list->product->name, 40)}}</td>
            <td scope="col">{{$list->number}}</td>
            <td scope="col">{{$list->product->price}}</</td>
            <td scope="col" class="text_ar">{{$list->product->price*$list->number}}</td>
        </tr>

        @php

            $price_total += $list->product->price*$list->number +$herd->delivery['delivery_rate_d']['price_rates'];
            $price_t += $list->product->price +$herd->delivery['delivery_rate_d']['price_rates'];
            $number += $list->number;
        @endphp
        @endforeach

            <?php
                $total_all += $price_total;


            ?>
        <tr >
            <td scope="col"></th>
            <td scope="col">การจัดส่ง : {{$herd->delivery['delivery_rate_d']['company']}}</th>
            <td scope="col"></th>
             <td scope="col">{{$herd->delivery['delivery_rate_d']['price_rates']}}</th>
            <td scope="col" class="text_ar">{{$herd->delivery['delivery_rate_d']['price_rates']}}</th>

          </tr>
        <tr class="foot_order">
            <td scope="col">รวม</th>
            <td scope="col"></th>
            <td scope="col">{{$number}}</th>
             <td scope="col">{{$price_t}}</th>
            <td scope="col" class="text_ar">{{$price_total}}</th>

          </tr>

    </tbody>

    @endforeach
  </table>

  <script type="text/javascript">
  console.log({{$total_all}});
    document.getElementById('price_total2').innerHTML = {{$total_all}};
  </script>



@endsection
