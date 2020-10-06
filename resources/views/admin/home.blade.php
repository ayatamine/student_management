@extends('admin.layouts.app')
@section('title','إعدادات الموقع')
@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            {{--<div class="col-sm-6">
              <h1 class="m-0 text-dark">الرئيسية</h1>
            </div><!-- /.col -->
             <div class="col-sm-6">
              <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">خانه</a></li>
                <li class="breadcrumb-item active">الرئيسية</li>
              </ol>
            </div ><!-- /.col -->
          </div><!-- /.row -->--}}
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid ">
            @if(Session::has('success'))

              <div class="alert alert-success alert-dismissible fade show col-sm-8 mr-auto ml-auto mb-3" role="alert">
                     {{Session::get('success')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
                <div class="card card-primary col-sm-8 p-0 m-auto">
                        <div class="card-header">
                          <h3 class="card-title">ظبط إعدادات الموقع</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form"  method="POST" action="{{route('updateSiteSettings')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                          <div class="card-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">اسم الموقع</label>
                            <input type="text" name="name" value="{{$settings->site_name}}" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">البريد الإلكتروني</label>
                              <input type="email" name="email" value="{{$settings->site_email}}" class="form-control" id="exampleInputEmail1">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputFile">الشعار</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="logo" class="custom-file-input" id="exampleInputFile">
                                  <label class="custom-file-label" for="exampleInputFile">{{$settings->logo}}</label>
                                </div>

                              </div>
                              <p>
                                <a class="btn btn-primary  btn-sm mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                  رؤية الشعار
                                  <i class="fa fa-eye "></i>
                                </a>
                              </p>
                              <div class="collapse" id="collapseExample">
                                <div class="card card-body ">
                                  <img src="{{asset('img').'/'.$settings->logo}}" class="m-auto"    width= "100px" height="80px" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->

                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                          </div>
                        </form>
                </div>
            </div>
        <!-- /.row -->
      </div>
 </div>
@endsection
