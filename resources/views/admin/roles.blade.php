
@extends('admin.layouts.app')
@section('title','إعدادات الأدوار ')
@section('style')
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte-rtl/plugins/datatables/dataTables.bootstrap4.css')}}">
  <style>
    label.error{
        color: red;
        font-weight: 500;
        margin-bottom: 0;
    }
  </style>
@endsection
@section('content')
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

              <div class="alert alert-success alert-dismissible fade show  mr-auto ml-auto mb-3" role="alert">
                 {{Session::get('success')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
            @if(Session::has('warning'))

              <div class="alert alert-warning alert-dismissible fade show  mr-auto ml-auto mb-3" role="alert">
                 {{Session::get('warning')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif

        </div>
        <div class="card">
                <div class="card-header bg-info">
                  <h3 class="card-title"> قائمة الطلبة الجدد</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">

                                </div>
                                <!-- /.card-body -->
                              </div>
                </div>
                <!-- /.card-body -->
              </div>

        </div>
      </div>
</div>

@endsection