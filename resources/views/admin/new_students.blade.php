
@extends('admin.layouts.app')
@section('title','إعدادات الطبة الجدد ')
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
                                  <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>الرقم</th>
                                      <th>اسم الطالب</th>
                                      <th>الرقم السري للطالب</th>
                                      <th>البريد</th>
                                      <th>القسم</th>
                                      <th>الحالة</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($new_students) > 0)
                                    @php $i=1;@endphp
                                    @foreach($new_students as $student)
                                    <tr>
                                      <td>{{$i++}}</td>
                                      <td>{{$student->name}}</td>
                                      <td>
                                          {{$student->id}}
                                      </td>
                                      <td>{{$student->email}}
                                        @if ($student->email_verified_at)
                                           <span class="badge badge-success">مفعل </span>
                                        @else
                                          <span class="badge badge-danger">غير مفعل</span>
                                        @endif
                                      </td>
                                      <td>
                                        <a href="javascript:void()" data-toggle="modal" data-target="#add_to_calss" id="show_add_to_class_modal"
                                         data-student_id="{{$student->id}}" type="button" class="btn btn-primary btn-sm float-right mr-1 ml-1">
                                          <i class="fa fa-plus" style="position:relative;top:3px"></i>
                                           اضافة </a>
                                      </td>
                                       <td>
                                         @if (!$student->state)

                                         <a href="{{route('student.activate_account',['student_id'=>$student->id])}}" type="button" class="btn btn-primary btn-sm text-white mr-1 ml-1" >
                                          <i class="fa fa-check " style="position:relative;top:3px"></i>
                                          تفعيل
                                         </a>
                                         @else
                                            <span class="badge badge-success">مفعل </span>
                                         @endif
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
              {{-- model add student --}}
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
                                <form role="form" id="addbf"  method="POST" action="" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body pb-0">
                                        <div class="form-group">
                                        <label for="name">اسم المستفيد</label>
                                        <input type="text"  name="name"  class="form-control" id="name" >
                                        </div>
                                        <div class="form-group">
                                        <label for="file_number">رقم الملف</label>
                                        <input type="text"  name="file_number"  class="form-control" id="file_number">
                                        </div>
                                        <div class="form-group">
                                        <label for="id_number">رقم الهوية</label>
                                        <input type="text" name="id_number"  class="form-control" id="id_number">
                                        </div>
                                        <div class="form-group">
                                        <label for="phone_number">رقم الجوال</label>
                                        <input type="number" name="phone_number" minlength="10" maxlength="12"  class="form-control" id="phone_number" placeholder="xxxxxxxxxx">
                                        </div>
                                        <div class="form-group">
                                        <label for="note">ملاحظات</label>
                                          <textarea name="note" class="w-100" id="note" rows="5"></textarea>

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
              <div class="modal fade" id="add_to_calss" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content mt-4">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            <form role="form" id="add_to_class_form"  method="POST" action="{{route('students.add_to_class')}}">
                                {{ csrf_field() }}
                                <div class="card-body pb-0">
                                    <div class="form-group">
                                    <label for="name">اسم القسم</label>
                                    <select name="class_id" id="class_id" class="form-control">
                                      <option value="0" disabled selected>اختر</option>
                                      @foreach ($classes as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                      @endforeach
                                    </select>
                                    <input type="hidden" name="student_id" id="student_id" class="form-control">
                                    </div>

                                </div>
                                <div class="card-footer pt-2">
                                  <button type="submit" class="btn btn-primary mr-3">إضافة</button>
                                </div>
                            </form>
                            </div>
                            <!-- /.card-body -->


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
  $(document).on('click','#show_add_to_class_modal',function(){
    let student_id = $(this).data('student_id');
    $('#student_id').val( student_id)
  })
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