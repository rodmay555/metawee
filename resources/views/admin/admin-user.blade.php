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

    @if(Session()->has('add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{Session()->get('add')}}
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
    <h2 class="h2">ข้อมูลผู้ใช้ (2)</h2>
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
                      <h5 class="modal-title" id="staticBackdropLabel">เพิ่มผู้ใช้</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                        <form method="POST" action="/admin/create_product" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="image">รูปภาพ</label>
                                <input type="file" class="form-control"  name="image" id="image">
                            </div>

                                <div class="form-group">
                                  <label class="label_category">ชื่อ</label>
                                  <input type="text" class="form-control" id="name"  name="name">

                                </div>

                                <div class="form-group">
                                    <label class="label_category">รายละเอียดสินค้า</label>
                                    <textarea class="description" id="description" name="description"  ></textarea>

                                  </div>

                                  <div class="form-group">
                                    <label class="label_category">ราคา</label>
                                    <input type="text" class="form-control" id="price"  name="price">

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



        {{-- @if($product->total()== 0 )

        <h2 class="not_data">ไม่มีข้อมูลสินค้า</h2>
        {{ $product->links() }}

        @else --}}
        <div class="table-responsive">
    <table class="table mat-10px">
        <thead>
          <tr>
            <th class="center width_num">ที่</th>
            <th class="center">รหัส</th>
            <th style="padding-left: 33px;">รูปภาพ</th>
            <th>ชื่อ</th>
            <th>รายละเอียดสินค้า</th>
            <th>ราคา</th>
            <th>หมวดสินค้า</th>
            <th class="center">action</th>
          </tr>
        </thead>
        <tbody>
         12

          <tr>

            <td class="center">
               12
            </td>
          <td class="center">123</td>
            <td >
                <img class="img-edit" src="#" alt="" width="100px" height="100px" >
            </td>
            <td >123</td>
            <td >123</td>
            <td >123</td>
            <td >123</td>
            <td class="center">


                {{-- modal --}}
                                    <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#staticBackdrop2">
                                แก้ไข
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">แก้ไขสินค้า</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>

                                    <div class="modal-body">
                                        <form method="POST" action="#" enctype="multipart/form-data">
                                            @csrf
                                                <img class="img-edit" src="#" alt="" width="200px" height="200px" >

                                                <div class="form-group">
                                                    <label class="label_category" for="image">รูปภาพ</label>
                                                    <input type="file" class="form-control"  name="image" id="image">
                                                </div>

                                                <div class="form-group">
                                                <label class="label_category">ชื่อ</label>
                                                <input type="text" class="form-control" id="name"  name="name" value="2">

                                                </div>


                                                  <div class="form-group">
                                                      <label class="label_category">รายละเอียดสินค้า</label>
                                                      <textarea class="description" id="description" name="description"  >2</textarea>

                                                    </div>

                                                    <div class="form-group">
                                                      <label class="label_category">ราคา</label>
                                                      <input type="text" class="form-control" id="price"  name="price" value="2">

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
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del2">
                                        ลบ
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="del2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

                                            <a href="#" class="btn btn-danger">ลบข้อมูล</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                            </div>

                                        </div>
                                        </div>
                                    </div>


                        {{-- endmodal --}}
            </td>
          </tr>

        </tbody>
      </table>


        </div>

@endsection
