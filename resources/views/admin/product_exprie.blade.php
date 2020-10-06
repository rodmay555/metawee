@extends('layouts.admin2')

@section('content')


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

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

    @if(Session()->has('delete'))


        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session()->get('delete')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

    @endif

    @if(Session()->has('delete1'))


        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session()->get('delete1')}}
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

    @if(Session()->has('update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{Session()->get('update')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <div class="heard">
    <h2 class="h2">สินค้าที่ใกล้หมด</h2>
    <h6 class="h6_d">จำนวนสินค้าที่ใกล้หมด</h6>
    <form action="/admin/product_expire" method="GET">
    <div class="row-pp">

    <select class="form-control wtih_t" id="exampleFormControlSelect1" name="number_product">

        <option value="10" @if($number_product == 10) selected @endif>10</option>
        <option value="20" @if($number_product == 20) selected @endif>20</option>
        <option value="30" @if($number_product == 30) selected @endif> 30</option>
        <option value="40" @if($number_product == 40) selected @endif>40</option>
        <option value="50" @if($number_product == 50) selected @endif>50</option>
      </select>
      <button type="submit" class="btn btn-info wtih_t btn_search">ค้นหา</button>
    </div>
</form>
    </div>







        <div class="table-responsive">
    <table class="table mat-10px">
        <thead>
          <tr>

            <th class="center width_category_id">รหัส</th>
            <th class=" width_category_name">ชื่อ</th>
            <th >จำนวนสินค้า</th>
            <th class="center width_category">จัดการ</th>
          </tr>
        </thead>
        <tbody>
            @foreach($product as $pro)

          <tr>

          <td class="center ">{{$pro->id}}</td>
            <td class="cat-name ">{{$pro->name}}</td>
            <td >{{$pro->number_product}}<span class="badge badge-danger p_">สินค้าที่ใกล้หมด</span></td>
            <td class="center ">


                {{-- modal --}}
                                    <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#staticBackdrop55">
                                เติมสินค้า
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop55" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">เติมสินค้า</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>

                                    <div class="modal-body">
                                    <form method="POST" action="/admin/add_product_exprie/{{$pro->id}}">
                                            @csrf


                                                <div class="form-group">
                                                <label class="label_category">จำนวนสินค้า</label>
                                                <input type="text" class="form-control" id="number_product"  name="number_product" value="{{$pro->number_product}}">

                                                </div>



                                    </div>
                                    <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                    </div>
                                </form>
                                </div>
                                </div>
                            </div>


                {{-- endmodal --}}

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

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

@endsection
