
@extends('admin.layouts.app')
@section('title','إعدادات القسم')
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
    .delete-matiere{display: block !important}
    .delete-matiere i{font-size: 1.5rem;cursor: pointer;
    position: relative;
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
          <div class="card-header row">
            <h3 class="card-title col-md-4 col-6 mb-2"> <span class="text-muted">القسم : </span><span class="text-primary">{{$class_details->name}}</span></h3>
            <h3 class="card-title col-md-4 col-6 mb-2"> <span class="text-muted">عدد أيام الدراسة : </span><span class="text-primary">{{$class_details->studing_day_number}}</span></h3>
            <h3 class="card-title col-md-4 col-6 mb-2"> <span class="text-muted">عدد الغيابات المسموحة : </span><span class="text-primary">{{$class_details->max_absence_number}}</span></h3>
          </div>
        </div>
        <div class="card">
          <div class="card-header bg-info">
            <h3 class="card-title"> <strong>قائمة المواد</strong></h3>
          </div>
          @php
            $bgcolors=['bg-success','bg-primary','bg-info','bg-success','bg-primary','bg-warning','bg-danger','bg-success','bg-primary','bg-info','bg-success','bg-primary','bg-warning','bg-danger','bg-primary','bg-warning','bg-danger',
                         'bg-success','bg-primary','bg-warning','bg-danger','bg-primary']
          @endphp
          @php
                $i=0;
          @endphp
          <div class="card-header">
            <h3 class="card-title">
                  <button type="button" class="btn btn-primary float-right mr-1 ml-1" data-toggle="modal" data-target="#add_matiere"><i class="fa fa-plus " style="position:relative;top:3px"></i> إضافة مادة</button>
                  <form action="{{route('matieres.upload')}}" method="post"
                   enctype="multipart/form-data" id="import_matieres">
                    @csrf
                     <label for="file"
                    class="btn btn-info float-right mr-1 ml-1" >
                    <i class="fa fa-upload " ></i> رفع CSV
                    </label>
                    <input type="file" name="file" id="file" class="d-none" onchange="importMatieres()">
                    <input type="hidden" name="class_id"  class="form-control" value="{{$class_details->id}}">
                  </form>
                  <a href="{{route('class_marks.export',['class_id'=>$class_details->id])}}"
                    class="btn btn-warning float-right"
                    ><i class="fa fa-download ml-1"></i>تنزيل الكشف </a>
                    <form action="{{route('class_marks.upload')}}" method="post"
                   enctype="multipart/form-data" id="import_marks" >
                    @csrf
                     <label for="file2"
                    class="btn bg-success float-right mr-1 ml-1" >
                    <i class="fa fa-upload " ></i> رفع الكشف
                    </label>
                    <input type="file" name="file" id="file2" class="d-none" onchange="importMarks()">
                    <input type="hidden" name="class_id"  class="form-control" value="{{$class_details->id}}">
                  </form>

            </h3>
          </div>
          <div class="card-body">
            <div class="row">
                @foreach ($class_details->matieres as $matiere )

              <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box {{$bgcolors[$i]}}">
                  <div class="inner">
                    <h4>{{$matiere->name}}</h4>

                    <p></p>
                  </div>
                  <div class="icon delete-matiere">
                    <a ><i class="fa fa-trash-o delete_matiere" type="button" data-toggle="modal"
                       data-target="#delete_matiere"
                       detach_link="{{route('classes.detachMatiere',['class'=>$class_details->id,'matiere'=>$matiere->id])}}"
                       delete_link="{{route('matieres.destroy',['matiere'=>$matiere->id])}}"
                       ></i></a>
                  </div>
                </div>
              </div>
              @php
                  $i++;
              @endphp
              @endforeach
            </div>

          </div>
        </div>
        <div class="card">
                <div class="card-header bg-info">
                  <h3 class="card-title"> <strong >قائمة الطلبة</strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">
                        {{--                  <button type="button" class="btn btn-info float-right mr-1 ml-1" data-toggle="modal" data-target="#addb"><i class="fa fa-plus " style="position:relative;top:3px"></i> إضافة</button>
                                  <button type="button" class="btn btn-info float- mr-1 ml-1" data-toggle="modal" data-target="#importxlxs"><i class="fa fa-file-excel-o"  style="position:relative;top:3px"></i> إستيراد xls</button>
                                        <a href="{{route('export_excel.excel')}}" type="button" class="btn btn-info float-right mr-1 ml-1" ><i class="fa fa-file-excel-o"  style="position:relative;top:3px"></i> تصدير xls</a>
                                        <a href="" target="_blink" type="button" class="btn btn-success float-left mr-1 ml-1" ><i class="fa fa-paper-plane-o"  style="position:relative;top:3px"></i> صفحة الإستعلام</a> --}}

                                  </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>الرقم</th>
                                      <th>اسم الطالب</th>
                                      <th>الرقم السري للطالب</th>
                                      <th>البريد</th>
                                      <th>عدد الغيابات</th>
                                      <th>اجراء</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($class_details->students) > 0)
                                    @php $i=1;@endphp
                                    @foreach($class_details->students as $student)
                                    <tr>
                                      <td>{{$i++}}</td>
                                      <td>{{$student->name}}</td>
                                      <td>
                                          {{$student->s_id}}
                                      </td>
                                      <td>{{$student->email}}</td>
                                       <td>{{$student->absence_number}}
                                        <a href="javascript:void()"  data-toggle="modal" data-target="#add_absence_modal" id="add_absence"
                                        type="button" class="text-info mr-1 ml-1"
                                        data-student_id="{{$student->id}}" data-absence_number="{{$student->absence_number}}" >
                                          <i class="fa fa-plus " style="position:relative;top:3px"></i>
                                           تغيير</a>
                                       </td>
                                       <td>
                                        <a  href="{{route('students.marks',['student_id'=>$student->id])}}"  type="button" class="text-primary mr-1 ml-1" >
                                           كشف العلامات</a>
                                       </td>
                                    </tr>

                                     @endforeach
                                    @endif
                                    </tbody>

                                    </tfoot>
                                  </table>
                                </div>
                                <!-- /.card-body -->
                              </div>
                </div>
                <!-- /.card-body -->
              </div>
              {{-- model add matiere --}}
              <div class="modal fade" id="add_matiere" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content mt-4">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                <form role="form" id="addbf"  method="POST" action="{{route('classes.attachmatiere')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body pb-0">
                                        <div class="form-group">
                                        <label for="name">اسم المادة</label>
                                        <select name="matiere_id" id="matiere_name" class="form-control">
                                          <option value="0" disabled selected>اختر</option>
                                          @foreach ($matieres as $matiere)
                                                <option value="{{$matiere->id}}">{{$matiere->name}}</option>
                                          @endforeach
                                        </select>
                                        <input type="hidden" name="class_id"  class="form-control" value="{{$class_details->id}}">
                                        </div>

                                    </div>
                                    <div class="card-footer pt-2">
                                      <button type="submit" class="btn btn-primary mr-3">إضافة</button>
                                      <a data-toggle="modal" data-target="#create_new_matiere" id="show_create_matiere_modal"
                                      class="text-danger float-left ml-3">مادة جديدة</a>
                                    </div>
                                </form>
                                </div>
                                <!-- /.card-body -->


                        </div>
                        <div class="modal-footer">

                        </div>
                      </div>
              </div>
              <div class="modal fade" id="create_new_matiere" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content mt-4">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                <form role="form" id="create_new_m"  method="POST" action="{{route('classes.create_add_matiere')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body pb-0">
                                        <div class="form-group">
                                        <label for="name">اسم المادة</label>
                                        <input type="text" name="matiere" id="matiere" value="{{old('matiere')}}" class="form-control">
                                        <input type="hidden" name="class_id"  class="form-control" value="{{$class_details->id}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="cofficient">المعامل (الضارب)</label>
                                          <input type="number" class="form-control" name="cofficient" id="">
                                        </div>
                                        <div class="form-group">
                                          <label for="total">العدد الجملي</label>
                                          <input type="number" class="form-control" name="total" id="">
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer pt-2">
                                    <button type="submit" class="btn btn-primary mr-3">إنشاء</button>
                                </div>
                                </form>
                        </div>
                        <div class="modal-footer">

                        </div>
                      </div>
              </div>
              <div class="modal fade" id="delete_matiere" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content mt-4">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                <form role="form" id="delete_matiere_form"  method="POST" action="" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body pb-0">
                                        <div class="form-group text-center">
                                          <a href="" type="button" id="detach_m" class="btn btn-warning  mr-1 ml-1" ><i class="fa fa-trash"  style="position:relative;top:3px"></i> حدف من القسم</a>
                                          <input type="submit" class="btn btn-danger  mr-1 ml-1"  value="حدف نهائي">
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
              <div class="modal fade" id="add_absence_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content mt-4">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            <form role="form" id="add_absence_form"  method="POST" action="{{route('students.add_absence')}}">
                                {{ csrf_field() }}
                                <div class="card-body pb-0">
                                    <div class="form-group">
                                    <label for="absence_number">عدد الغيابات <strong>العدد المسموح <span class="text-danger">{{$class_details->max_absence_number}}</span></strong></label>
                                    <input id="absence_number" type="number" class="form-control" name="absence_number"
                                    min="0" >
                                    <input type="hidden" name="student_id" id="student_id" class="form-control">
                                    </div>

                                </div>
                                <div class="card-footer pt-2">
                                  <button type="submit" class="btn btn-primary mr-3">حفظ</button>
                                </div>
                            </form>
                            </div>
                            <!-- /.card-body -->


                    </div>
                  </div>
              </div>
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
    $(document).on('click','#show_create_matiere_modal',function(){
      $('#add_matiere').modal('hide');
    })
    $(document).on('click','.delete_matiere',function(){
      let detach_link = $(this).attr('detach_link');
      let delete_link = $(this).attr('delete_link');
      $('#detach_m').attr('href',detach_link);
      $('#delete_matiere_form').attr('action',delete_link);
    })
    $(document).on('click','#add_absence',function(){
    let student_id = $(this).data('student_id');
    let absence_number = $(this).data('absence_number')
    $('#student_id').val( student_id)
    $('#absence_number').val(absence_number)
    /* $('#absence_number').attr('min',absence_number) */
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
  /* $( "#add_absence_form" ).validate({
    rules: {
        absence_number: {
        required :true,
        minlength: parseInt($('#add_absence').data('absence_number')) ,
        maxlength: parseInt($("#absence_number").attr('maxlength')) ,
        number: true
        },

    }
     ,
    submitHandler: function(form) {
       form.submit();
     }

    });
 */
 function importMatieres(){
  document.getElementById('import_matieres').submit();
 }
 function importMarks(){
  document.getElementById('import_marks').submit();
 }
</script>
@endsection
@endsection