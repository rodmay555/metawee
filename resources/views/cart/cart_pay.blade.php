@extends('layouts.app')

@section('content')

<script src="{{ asset('js/fontwee.js') }}" defer></script>
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

    <form method="POST" action="/pay/{{$number_order}}" enctype="multipart/form-data">
                @csrf
                    <div class="opp1">
                        <a class="opp2" href="/order"><i class="fas fa-arrow-left"></i></a>
                        ชำระเงิน</div>
                    <div class="content_pay1">


                        <div class="price_pay"><p class="titprice_y">ยอดการชำระเงินทั้งหมด : </p><p class="price_y">฿<span id="price_All_pay">{{$price_net}}</span></p></div>


                        {{-- <div class="form-group">

                            <label class="pay_image" for="image">อัพโหลดหลักฐานการชำระเงิน</label>
                            <input type="file" class="form-control"  name="image" id="image">
                        </div> --}}

                        <div class="form-group h-pay0">



                        <div class="kb">
                                <p class="hard_123">ไทยพาณิชย์(SCB)</p>
                                <p>ชื่อบัญชี: เมธาวี 123</p>
                                <p>เลขที่บัญชี 468 0601 709</p>
                        </div>

                        <div class="kb">
                            ชำระเงินก่อนวันที่ {{date("d/m/Y H:i:s", strtotime($hard_order->deadline_pay))}}



                    </div>




                            <div class="input-group file_pay">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFileAddon01">อัพโหลดหลักฐานการชำระเงิน</span>
                                </div>
                                <div class="custom-file">
                                  <input name="image" id="image" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                              </div>





                        </div>

                    </div>





                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-pay" data-toggle="modal" data-target="#pay">
                                        ชำระเงิน
                                    </button>

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

                                                    <h2 class="del">ต้องการยืนยันการชำระเงินนี้ไหม</h2>


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


        <?php

        ?>

        {{-- endmodal --}}
                    <script>
document.getElementById("number_All").innerHTML = {{$numberAll}} ;
                        $(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});






                    </script>



                    @endsection



