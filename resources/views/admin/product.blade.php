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

    @if(Session()->has('delete1'))


<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{Session()->get('delete1')}}
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
    <h2 class="h2">สินค้า ({{$product->total()}})</h2>
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
                      <h5 class="modal-title" id="staticBackdropLabel">เพิ่มสินค้า</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                        <form method="POST" action="/admin/create_product" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="check" name="check" value="0">

                            <div class="form-group">
                                <label for="image">รูปภาพ @error('image')<label  class="label_v">{{ $message }}</label>@enderror</label>
                                <input type="file" class="form-control" value="" name="image" id="image">
                            </div>

                            <div class="form-group">
                                <label class="label_category" for="image2">รูปภาพที่2</label>
                                <input type="file" class="form-control"  name="image2" id="image2">
                            </div>

                            <div class="form-group">
                                <label class="label_category" for="image3">รูปภาพที่3</label>
                                <input type="file" class="form-control"  name="image3" id="image3">
                            </div>

                            <div class="form-group">
                                <label class="label_category" for="image4">รูปภาพที่4</label>
                                <input type="file" class="form-control"  name="image4" id="image4">
                            </div>

                                <div class="form-group">
                                  <label class="label_category">ชื่อ @error('name')<label  class="label_v">{{ $message }}</label>@enderror</label>
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name">

                                </div>

                                <div class="form-group">
                                    <label class="label_category">รายละเอียดสินค้า  @error('description')<label  class="label_v">{{ $message }}</label>@enderror  </label>
                                    <textarea class=" form-control textarea @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>

                                  </div>


                                  <div class="form-group">
                                  <label class="label_category">จำนวนสินค้า @error('number_product')<label  class="label_v">{{ $message }}</label>@enderror</label>
                                  <input type="text" class="form-control @error('number_product') is-invalid @enderror" id="number_product" value="{{old('number_product')}}" name="number_product">

                                  </div>

                                  <div class="form-group">
                                    <label class="label_category">ราคา @error('price')<label  class="label_v">{{ $message }}</label>@enderror</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" value="{{old('price')}}" name="price">

                                  </div>


                                  <div class="form-group">
                                    <label for="Select1">หมวดสินค้า</label>
                                    <select class="form-control" id="category_id" name="category_id">

                                        @foreach($category as $cat)
                                      <option value="{{$cat->id}}" >{{$cat->name}}</option>
                                        @endforeach

                                    </select>
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



        @if($product->total()== 0 )

        <h2 class="not_data">ไม่มีข้อมูลสินค้า</h2>
        {{ $product->links() }}

        @else
        <div class="table-responsive">
    <table class="table mat-10px">
        <thead>
          <tr>

            <th class="center">รหัส</th>
            <th style="padding-left: 33px;">รูปภาพ</th>
            <th style="padding-left: 33px;">รูปภาพ2</th>
            <th style="padding-left: 33px;">รูปภาพ3</th>
            <th style="padding-left: 33px;">รูปภาพ4</th>
            <th>ชื่อ</th>
            <th>รายละเอียดสินค้า</th>
            <th>จำนวนสินค้า</th>
            <th>ราคา</th>
            <th>หมวดสินค้า</th>
            <th class="center">จัดการ</th>
          </tr>
        </thead>
        <tbody>

            @foreach($product as $pro)
          <tr>


          <td class="center">{{$pro->id}}</td>
            <td >
                <img class="img-edit" src="{{ asset('storage') }}/product_image/{{ $pro->image }}" alt="" width="100px" height="100px" >
            </td>
            <td >
            @if($pro->image2)    <img class="img-edit" id="i_img2{{$pro->id}}"  src="{{ asset('storage') }}/product_image/{{ $pro->image2 }}"  alt="" width="100px" height="100px" >@endif
            </td>
            <td >
                @if($pro->image3)   <img class="img-edit" id="i_img3{{$pro->id}}" src="{{ asset('storage') }}/product_image/{{ $pro->image3 }}" alt="" width="100px" height="100px" >@endif
            </td>
            <td >
                @if($pro->image4)  <img class="img-edit" id="i_img4{{$pro->id}}" src="{{ asset('storage') }}/product_image/{{ $pro->image4 }}" alt="" width="100px" height="100px" >@endif
            </td>
            <td >{{Str::limit($pro->name,32) }}</td>
            <td >{{ Str::limit($pro->description,32) }}</td>
            <td class="number_product">{{$pro->number_product}} @if($pro->number_product <=10)<p  class="btn1 p_danger">สินค้าใกล้หมด</p>@endif</td>
            <td >{{$pro->price}}</td>
            <td >{{$pro->category['name']}}</td>
            <td class="center">


                {{-- modal --}}
                                    <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#staticBackdrop{{$pro->id}}">
                                แก้ไข
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop{{$pro->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">แก้ไขสินค้า</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>

                                    <div class="modal-body">
                                        <form method="POST" action="/admin/update_product/{{$pro->id}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="check" name="check" value="{{$pro->id}}">
                                                <img class="img-edit" src="{{ asset('storage') }}/product_image/{{ $pro->image }}" alt="" width="200px" height="200px" >

                                                <div class="form-group">
                                                    <label class="label_category" for="image">รูปภาพ</label>
                                                    <input type="file" class="form-control"  name="image" id="image">

                                                </div>

                                                @if($pro->image2)<img class="img-edit" id="img2{{$pro->id}}" src="{{ asset('storage') }}/product_image/{{ $pro->image2 }}" alt="" width="200px" height="200px" >@endif

                                                <div class="form-group">
                                                    <label class="label_category" for="image2">รูปภาพที่2</label>
                                                    <input type="file" class="form-control"  name="image2" id="image2">
                                                    @if($pro->image2)<button type="button" class="btn btn-danger fu-btn" id="btnimg2{{$pro->id}}" onclick="deleteimage({{$pro->id}},'image2')">ลบ</button>@endif
                                                </div>

                                                @if($pro->image3)<img class="img-edit" id="img3{{$pro->id}}" src="{{ asset('storage') }}/product_image/{{ $pro->image3 }}" alt="" width="200px" height="200px" >>@endif

                                                <div class="form-group">
                                                    <label class="label_category" for="image3">รูปภาพที่3</label>
                                                    <input type="file" class="form-control"  name="image3" id="image3">
                                                    @if($pro->image3) <button type="button" class="btn btn-danger fu-btn" id="btnimg3{{$pro->id}}" onclick="deleteimage({{$pro->id}},'image3')">ลบ</button>@endif
                                                </div>

                                                @if($pro->image4)<img class="img-edit" id="img4{{$pro->id}}" src="{{ asset('storage') }}/product_image/{{ $pro->image4 }}" alt="" width="200px" height="200px" >@endif

                                                <div class="form-group">
                                                    <label class="label_category" for="image4">รูปภาพที่4</label>
                                                    <input type="file" class="form-control"  name="image4" id="image4">
                                                    @if($pro->image4) <button type="button" class="btn btn-danger fu-btn" id="btnimg4{{$pro->id}}" onclick="deleteimage({{$pro->id}},'image4')">ลบ</button>@endif
                                                </div>





                                                <div class="form-group">
                                                <label class="label_category">ชื่อ</label>
                                                <input type="text" class="form-control" id="name"  name="name" value="{{$pro->name}}">

                                                </div>


                                                  <div class="form-group">
                                                      <label class="label_category">รายละเอียดสินค้า</label>
                                                      <textarea class="description" id="description" name="description"  >{{$pro->description}}</textarea>

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="label_category">จำนวนสินค้า</label>
                                                    <input type="text" class="form-control" id="number_product"  name="number_product" value="{{$pro->number_product}}">

                                                      </div>

                                                    <div class="form-group">
                                                      <label class="label_category">ราคา</label>
                                                      <input type="text" class="form-control" id="price"  name="price" value="{{$pro->price}}">

                                                    </div>


                                                    <div class="form-group">
                                                      <label class="label_category">หมวดสินค้า</label>
                                                      <select class="form-control" id="category_id" name="category_id" >
                                                          @foreach($category as $cat)
                                                        <option value="{{$cat->id}}" @if($pro->category_id == $cat->id)
                                                            selected
                                                            @endif
                                                            >{{$cat->name}}</option>
                                                          @endforeach
                                                      </select>
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
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del{{$pro->id}}">
                                        ลบ
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="del{{$pro->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

                                            <a href="/admin/delete_product/{{$pro->id}}/{{$product->currentPage()}}/{{$product->count()}}" class="btn btn-danger">ลบข้อมูล</a>
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

      {{ $product->links() }}
        </div>
      @endif
@endsection
