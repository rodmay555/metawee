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

    <h2 class="h2">ยอดการขายประจำปี {{$time}}</h2>
    </div>
    <form method="get" action="sales_annual_s">
    <div class="row-pp with-date">
        <h4 class="all_pp">ยอดรวม : <span class="color_re" id="sales">5000</span> </h4>
        <div class="form-group">
        <div class="input-group date date_order1" id="datetimepicker7" data-target-input="nearest">
             <input type="text" class="form-control datetimepicker-input" name="date1" data-target="#datetimepicker7" required/>
             <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                 <div class="input-group-text"><i class="fa fa-calendar"></i></div>
             </div>
         </div>
     </div> <span class="span-pp"></span>   <div class="form-group">
        {{-- <div class="input-group date date_order2" id="datetimepicker8" data-target-input="nearest">
             <input type="text" class="form-control datetimepicker-input" name="date2" data-target="#datetimepicker8" required/>
             <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                 <div class="input-group-text"><i class="fa fa-calendar"></i></div>
             </div>
         </div> --}}
     </div> <button type="submit" class="btn btn-info wbtn">ค้นหา</button></div>
    </form>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker7').datetimepicker({
                format: 'YYYY'
            });
            // $('#datetimepicker8').datetimepicker({
            //     useCurrent: false,
            //     format: 'DD/MM/YYYY'
            // });
            // $("#datetimepicker7").on("change.datetimepicker", function (e) {
            //     $('#datetimepicker8').datetimepicker('minDate', e.date);
            // });
            // $("#datetimepicker8").on("change.datetimepicker", function (e) {
            //     $('#datetimepicker7').datetimepicker('maxDate', e.date);
            // });
        });
    </script>


<table class="table order-admin-table">
    <thead>
      <tr>
        <th scope="col">ลำดับ</th>
        <th scope="col">รูป</th>
        <th scope="col">สินค้า</th>
        <th scope="col">ราคา</th>
        <th scope="col">จำนวน</th>
        <th scope="col">ราคารวม</th>

      </tr>
    </thead>
    <tbody>
        <?php
            $i=1;
            $price_sales = 0;
        ?>
        @foreach($product as $pro)
                <?php
                $number[$pro->id]=0;

                ?>

@endforeach
            @foreach($order_herd as $herd)
            @if($herd->status > 1 && $herd->status < 6)
            @foreach($herd->order_list as $list)

                    <?php $number[$list->product_id] += $list->number ?>

            @endforeach
            @endif
            @endforeach
        @foreach($product as $pro)


        <tr>
        <td scope="col">{{$i}}</td>
            <td scope="col"><img class="img-edit" src="{{ asset('storage') }}/product_image/{{$pro->image}}" alt="" width="70px" height="70px" ></td>
            <td scope="col">{{$pro->name}}</td>
            <td scope="col">{{$pro->price}}</td>
            <td scope="col">{{$number[$pro->id]}}</td>
            <td scope="col">{{$pro->price*$number[$pro->id]}}</td>
        </tr>

        <?php
        $i+=1;
        $price_sales += $pro->price*$number[$pro->id];
    ?>
         @endforeach

    </tbody>
  </table>

  <script type="text/javascript">
    document.getElementById('sales').innerHTML = {{$price_sales}};

  </script>



@endsection
