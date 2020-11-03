
@extends('admin.layouts.app')
@section('title','إعدادات الأقسام')
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
    .delete-class{display: block !important}
    .delete-class i{font-size: 1.5rem;
    position: relative;cursor: pointer;
    top: -3rem;}
    @media (max-width: 767.98px){
    .small-box {
        text-align: right;
    }
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

        </div>
        <div class="card">
                <div class="card-header">
                  <h3 class="card-title"> قائمة الأقسام</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">
                                        <button type="button" class="btn btn-info float-right mr-1 ml-1" data-toggle="modal" data-target="#addb"><i class="fa fa-plus " style="position:relative;top:3px"></i> إضافة</button>

                                  </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  @php
                                    $bgcolors=['bg-success','bg-primary','bg-info','bg-success','bg-primary','bg-warning','bg-danger','bg-success','bg-primary','bg-info','bg-success','bg-primary','bg-warning','bg-danger','bg-primary','bg-warning','bg-danger',
                                    'bg-success','bg-primary','bg-warning','bg-danger','bg-primary']
                                  @endphp
                                  <div class="row">
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($classes as $class)
                                    <div class="col-lg-3 col-6">
                                      <!-- small box -->
                                      <div class="small-box {{$bgcolors[$i]}}">
                                        <div class="inner">
                                          <h4>{{$class->name}}</h4>

                                          <p>{{count($class->students)}} طالب</p>
                                        </div>
                                        <div class="icon delete-class">
                                          <a  ><i class="fa fa-trash-o delete_class" type="button"  data-toggle="modal"
                                            data-target="#delete_class"
                                            delete_link="{{route('classes.destroy',['class'=>$class->id])}}" ></i></a>
                                        </div>
                                        <a href="{{route('classes.show',['class'=>$class->id])}}" class="small-box-footer">زيارة <i class="fa fa-arrow-circle-left"></i></a>
                                      </div>
                                    </div>
                                    <!-- ./col -->
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                  </div>
                                </div>
                                <!-- /.card-body -->
                              </div>
                </div>
                <!-- /.card-body -->
              </div>
              {{-- model add class --}}
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
                                <form role="form" id="addbf"  method="POST" action="{{route('classes.store')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body pb-0">
                                        <div class="form-group">
                                        <label for="name">اسم القسم</label>
                                        <input type="text"  name="name"  class="form-control" id="name" >
                                        </div>
                                        <div class="form-group">
                                        <label for="studing_day_number">عدد أيام الدراسة</label>
                                        <input type="number"  name="studing_day_number"  class="form-control" id="studing_day_number">
                                        </div>
                                        <div class="form-group">
                                        <label for="max_absence_number">عدد الغيابات المسموح</label>
                                        <input type="number" name="max_absence_number"  class="form-control" id="max_absence_number">
                                        </div>

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
              {{-- model delete class --}}
              <div class="modal fade" id="delete_class" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content mt-4">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            <form role="form" id="delete_class_form"  method="POST" action="" >
                                {{ csrf_field() }}
                                <div class="card-body pb-0">
                                    <div class="form-group text-center">
                                      <input type="submit" class="btn btn-danger  mr-1 ml-1"  value="تأكيد الحدف">
                                        @method('delete')
                                    </div>

                                </div>
                              </form>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer pt-2">
                            </div>

                    </div>
                  </div>
              </div>
              {{-- model add student --}}
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
                                      <button class="btn btn-success">استيراد</button>
                                  </div>
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
  $(document).on('click','.delete_class',function(){
      let delete_link = $(this).attr('delete_link');
      $('#delete_class_form').attr('action',delete_link);
    })
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