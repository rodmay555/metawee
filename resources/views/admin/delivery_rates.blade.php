@extends('layouts.admin')

@section('content')
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
    <h2 class="h2">บริการจัดส่ง</h2>
    <div class="btn-create">

        <!-- Button trigger modal -->
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">
                เพิ่ม
              </button>
            </div>
              <!-- Modal -->
              <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">เพิ่มบริการจัดส่ง</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                        <form method="POST" action="/admin/add/delivery">
                            @csrf
                                <div class="form-group">
                                  <label class="label_category">ชื่อบริษัท</label>
                                  <input type="text" class="form-control" id="company"  name="company">

                                </div>
                                <div class="form-group">
                                  <label class="label_category">ราคาส่ง</label>
                                  <input type="text" class="form-control" id="price_rates"  name="price_rates">

                                </div>



                    </div>
                    <div class="modal-footer">

                      <button type="submit" class="btn btn-success">เพิ่ม</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
    </div>








        <div class="table-responsive">
    <table class="table mat-10px">
        <thead>
          <tr>

            <th class="center width_category_id">รหัส</th>
            <th class=" width_category_name">ชื่อบริษัท</th>
            <th >ราคาส่ง</th>
            <th class="center width_category">จัดการ</th>
          </tr>
        </thead>
        <tbody>

            @foreach($delivery as $deli)
          <tr>

          <td class="center ">{{$deli->id}}</td>
            <td class="cat-name ">{{$deli->company}}</td>
          <td >{{$deli->price_rates}}</td>
            <td class="center ">


                {{-- modal --}}
                                    <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#staticBackdrop{{$deli->id}}">
                                แก้ไข
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop{{$deli->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">แก้ไขบริการจัดส่ง</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>

                                    <div class="modal-body">
                                    <form method="POST" action="/admin/update_delivery/{{$deli->id}}">
                                            @csrf


                                            <div class="form-group">
                                                <label class="label_category">ชื่อบริษัท</label>
                                                <input type="text" class="form-control" id="company"  name="company" value="{{$deli->company}}">

                                              </div>
                                              <div class="form-group">
                                                <label class="label_category">ราคาส่ง</label>
                                                <input type="text" class="form-control" id="price_rates"  name="price_rates" value="{{$deli->price_rates}}">

                                              </div>


                                    </div>
                                    <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary">แก้ไข</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                    </div>
                                </form>
                                </div>
                                </div>
                            </div>


                {{-- endmodal --}}



                {{-- modal ลบสินค้า --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del{{$deli->id}}">
                                        ลบ
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="del{{$deli->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

                                            <a href="/admin/delete/delivery/{{$deli->id}}" class="btn btn-danger">ลบข้อมูล</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                            </div>

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

@endsection
