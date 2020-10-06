
@extends('admin.layouts.app')
@section('title','إعدادات المستفيدين')
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
            @if($errors)
              @foreach($errors as $err)
              <div class="alert alert-success alert-dismissible fade show  mr-auto ml-auto mb-3" role="alert">
                  {{$err}}   
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endforeach
            @endif
            
        </div>
        
        <div class="card">
                <div class="card-header">
                  <h3 class="card-title">جدول بقائمة المشرفين</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">
                                      <button type="button" class="btn btn-info btn-sm float-right mr-1 ml-1" 
                                      data-toggle="modal" data-target="#addb">
                                      <i class="fa fa-plus " style="position:relative;top:3px"></i>
                                       إضافة</button>
                                  </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>الاسم</th>
                                      <th>البريد الإلكتروني</th>
                                      <th>تعيين كمشرف</th>
                                      <th> حدف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($users) > 0)
                                    @foreach($users as $user)
                                    <tr>
                                      <td>{{$user->name}}</td>
                                      <td>
                                          {{$user->email}}
                                      </td>
                                       <td>
                                         @if($user->admin)
                                         <a href="{{route('make_non_admin',['id'=>$user->id])}}" type="button" class="btn btn-info btn-sm float-right mr-1 ml-1" >
                                          <i class="fa fa-minus " style="position:relative;top:3px"></i>
                                            إلغاء التعيين </a>
                                          @else
                                          <a href="{{route('make_admin',['id'=>$user->id])}}" type="button" class="btn btn-info btn-sm float-right mr-1 ml-1" >
                                          <i class="fa fa-plus " style="position:relative;top:3px"></i>
                                           تعيين</a>
                                          @endif

                                       </td>
                                       <td>
                                        <a href="{{route('delete_supervisor',['id'=>$user->id])}}" type="button" class="btn btn-danger btn-sm float-right mr-1 ml-1" >
                                          <i class="fa fa-trash " style="position:relative;top:3px"></i>
                                           حدف</a>
                                       </td>
                                    </tr>
                                     @endforeach
                                    @endif
                                   
                                    
                                    </tfoot>
                                  </table>
                                </div>
                                <!-- /.card-body -->
                              </div>
                </div>
                <!-- /.card-body -->
              </div>
              {{-- model add benificier --}}
              <div class="modal fade" id="addb" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content mt-4">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                <form class="form-horizontal" method="POST" action="{{ route('register_supervison') }}">
                                        {{ csrf_field() }}
                
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class=" control-label">الاسم</label>
                                            <div class="">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            
                
                                        </div>
                
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class=" control-label">البريد الإلكتروني</label>
                
                                            <div class="">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                
                                        </div>
                
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class=" control-label">كلمة السر</label>
                
                                            <div class="">
                                                <input id="password" type="password" class="form-control" name="password" required>
                
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                
                                        </div>
                
                                        <div class="form-group">
                                            <label for="password-confirm" class=" control-label">إعادة كلمة السر</label>
                
                                            <div class="">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                
                                        </div>
                
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    تسجيل
                                                </button>
                                            </div>
                                        </div>
                                    </form>       
                                                        
                                                
                                     
                        </div>
                        <div class="modal-footer">
                          
                        </div>
                      </div>
              </div>
              {{-- model add benificier --}}
              <div class="modal fade"  id="importxlxs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content mt-4">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                              <form role="form" action="{{ route('import_excel.excel') }}" method="POST" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="card-body pb-0">
                                      <input type="file" name="file" class="form-control">
                                      <br>
                                      <button class="btn btn-success">Import User Data</button>
                                  </div>
                              </div>
                              <!-- /.card-body -->
              
                              <div class="card-footer pt-0">
                                  <button type="submit" class="btn btn-primary mr-3">إضافة</button>
                              </div>
                              </form>
                      </div>
                      <div class="modal-footer">
                        
                      </div>
                    </div>
            </div>
              </div>
      </div>
</div>
@section('js')
    

<script src="{{asset('adminlte-rtl/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('adminlte-rtl/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte-rtl/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte-rtl/plugins/fastclick/fastclick.js')}}"></script>

<!-- AdminLTE for demo purposes
<script src="../../dist/js/demo.js"></script>
 page script -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
 <script>
 jQuery.extend(jQuery.validator.messages, {
    required: "هذا الحقل ضروري",
    remote: "Please fix this field.",
    email: "Please enter a valid email address.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "ادخل رقما صحيحا",
    digits: "Please enter only digits.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    minlength: jQuery.validator.format("ادخل رقم الجوال أكثر من 10 أحرف."),
    maxlength: jQuery.validator.format("ادخل رقم الجوال أقل من 12 حرف."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});
 </script>
<script>
  $(function () {
    $("#example1").DataTable({
        "language": {
            "paginate": {
                "next": "التالي",
                "previous" : "السابق"
            }
        },
        "info" : false,
    });  
    /* $('#example2').DataTable({
         "language": {
            "paginate": {
                "next": "بعدی",
                "previous" : "قبلی"
            }
        }, 
      "info" : false,
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "autoWidth": false
    }); */
  });
  $( "#addbf" ).validate({
    rules: {
        name:{
            required :true
        },
        phone_number: {
        required :true,
        minlength: 10,
        number: true
        },
        file_number: {
        required :true,
        number: true
        },
        id_number: {
        required :true,
        number: true
        }
        
    }
     ,
    submitHandler: function(form) {
       form.submit();
     }

    });
</script>
@endsection
@endsection