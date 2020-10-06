@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ข้อมูลส่วนตัว 
                                    <button type="button" class="btn btn-outline-danger home_btn1" data-toggle="modal" data-target="#pass{{$user->id}}">แก้ไขรหัสผ่าน</button>
                
                                    <div class="modal fade" id="pass{{$user->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog dialog_home" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">แก้ไขรหัสผ่าน</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">

                    <div class="card-body">
                        <form method="POST" action="/home/update_password/{{Auth::user()->id}}">
                            @csrf
                            
                            <div class="text_modal_home">

                            <div class="form-group row">
                            <label for="password_old" class="col-md-3 col-form-label text-md-right">รหัสผ่านเก่า</label>

                            <div class="col-md-6">
                                <input id="password_old" type="password" class="form-control @error('password_old') is-invalid @enderror" name="password_old" required autocomplete="password_old">

                                @error('password_old')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                        </div>

                        
                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">รหัสผ่านใหม่</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right">ยืนยันรหัสผ่านใหม่</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        </div>



                    </div>
                    </div>
                    <div class="modal-footer">

                      <button type="submit" class="btn btn-success">แก้ไขรหัสผ่าน</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    </div>
                </form>
                  </div>
                </div>
                
              </div></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p><span class="home">ชื่อผู้ใช้ : </span>{{$user->name}}</p>
                    <p><span class="home">ชื่อ : </span>{{$user->firstname}}<span class="home"> นามสกุล : </span>{{$user->lastname}}</p>
                    <p><span class="home">เบอร์โทร : </span>{{$user->phone_number}}</p>
                    <p><span class="home">อีเมล์ : </span>{{$user->email}}</p>
                    <p><span class="home">ที่อยู่ : </span>{{$user->address}}</p>
                   
                   
                    <button type="button" class="btn btn-primary home_btn" data-toggle="modal" data-target="#user{{$user->id}}">แก้ไข</button>

                    <div class="modal fade" id="user{{$user->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog dialog_home" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">แก้ไขข้อมูลส่วนตัว</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>

                            <div class="modal-body">
                                <form method="POST" action="/home/update/{{$user->id}}" >
                                    @csrf

                                    <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">ชื่อผู้ใช้</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" placeholder="ชื่อผู้ใช้" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">ชื่อ-นามสกุล</label>

                                        <div class="row-input">
                                            <input id="firstname" type="text" class="form-control input-1 @error('firstname') is-invalid @enderror" name="firstname" value="{{$user->firstname}}" placeholder="ชื่อ" required autocomplete="firstname" >
                                            <input id="lastname" type="text" class="form-control input-2 @error('lastname') is-invalid @enderror" name="lastname" value="{{$user->lastname}}" placeholder="นามสกุล" required autocomplete="lastname" >
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
                                        <label for="email" class="col-md-3 col-form-label text-md-right">อีเมล์</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" placeholder="อีเมล์"  required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone_number" class="col-md-3 col-form-label text-md-right">เบอร์โทร</label>

                                        <div class="col-md-6">
                                            <input id="phone_number" type="phone_number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{$user->phone_number}}" placeholder="เบอร์โทร"  required autocomplete="phone_number">

                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="address" class="col-md-3 col-form-label text-md-right">ที่อยู่</label>

                                        <div class="col-md-6">
                                            <textarea id="address"  class="form-control textarea @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"placeholder="ที่อยู่..."  required >{{$user->address}}</textarea>

                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                 

                                




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


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@if(Auth::check())
<script>
    document.getElementById("number_All").innerHTML = {{$numberAll}} ;
</script>
@endif
@endsection
