
@extends('admin.layouts.app')
@section('title','إعدادات العلامات')
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
            <h3 class="card-title col-md-4 col-6 mb-2"> <span class="text-muted">الطالب : </span><span class="text-primary">{{$student->name .'/ '.$student->s_id}}</span></h3>
            <h3 class="card-title col-md-4 col-6 mb-2"> <span class="text-muted">القسم  : </span><span class="text-primary">{{$student->class->name}}</span></h3>
            <h3 class="card-title col-md-4 col-6 mb-2"> <span class="text-muted">عدد المواد : </span><span class="text-primary">{{count($student->class->matieres)}}</span></h3>
          </div>
        </div>
        <div class="card" id="marks">
                <div class="card-header bg-info">
                  <h3 class="card-title"> <strong >قائمة العلامات لكل مادة</strong></h3>
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
                                        <th class="bg-success"><strong>المادة</strong></th>
                                        @foreach ($student->marks as $mark)
                                            <th>{{$mark->matiere->name}}</th>
                                        @endforeach
                                      </tr>
                                      </thead>
                                      <tbody>

                                        <tr>
                                          <td class="bg-primary"><strong>العلامة</strong></td>
                                          @foreach ($student->marks as $mark)
                                              <td> {{$mark->matiere->total}} / <strong class="text-success">{{$mark->mark}} </strong> </td>
                                          @endforeach
                                          <td>
                                            <a  href="javascript:void()" data-target="#edit_marks"
                                             data-toggle="modal" type="button" class="text-primary mr-1 ml-1" >
                                             <i class="fa fa-edit mr-1"></i> تعديل </a>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="bg-info"><strong>المعامل</strong></td>
                                          @foreach ($student->marks as $mark)
                                              <td>{{$mark->matiere->cofficient}}</td>
                                          @endforeach
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td class="bg-warning"><strong>النتيجة</strong></td>
                                          @foreach ($student->marks as $mark)
                                              <td>
                                                /
                                              </td>
                                          @endforeach
                                          <td>
                                             <strong class={{$student->marksAverage()['result'] > 10 ? 'text-success' : 'text-danger'}}>
                                              {{$student->marksAverage()['result']}}</strong>
                                          </td>

                                        </tr>


                                      </tbody>
                                  </table>
                                </div>
                                <!-- /.card-body -->
                              </div>
                </div>
                <!-- /.card-body -->
              </div>
              <div class="bg-white p-3 text-center">
                <button type="button" class="btn btn-default" onclick="printtag('marks')"
                ><i class="fa fa-print"></i> طباعة الكشف</button>
                <button type="button" class="btn btn-info" onclick="printtagAndDisplay('present_certificate')"
                ><i class="fa fa-print"></i> شهادة الحضور</button>
                <button type="button" class="btn btn-success" onclick="printtagAndDisplay('success_certificate')"
                ><i class="fa fa-print"></i> شهادة الاجتياز</button>
              </div>
              <div id="present_certificate" style="opacity: 0">
                <h5 class="text-center">شهادة حضور</h5>
                <h6>الى الطالب {{$student->name}}</h6>

                 إن {{$settings->site_name}} تتمنى لك أسمى عبارات التقدير والنجاح في مشوارك وتشكرك على الحضور
              </div>
              <div id="success_certificate" style="opacity: 0">
                <h5 class="text-center">شهادة اجتياز</h5>
                <h6>الى الطالب {{$student->name}}</h6>

                 إن {{$settings->site_name}} تتمنى لك أسمى عبارات التقدير والنجاح في مشوارك وتشكرك على اجتيازك له المرحلة بنجاح
              </div>
              <div class="modal fade" id="edit_marks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content mt-4">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                <form role="form" id="edit_marks_form"  method="POST" action="{{route('students.update_marks',['student_id'=>$student->id])}}" >
                                    {{ csrf_field() }}
                                    <div class="card-body pb-0">
                                      <input type="hidden" name="student_id"  class="form-control" value="{{$student->id}}">
                                       <div class="row">
                                         @foreach ($student->marks as $mark)
                                        <div class="form-group col-sm-4 col-md-3">
                                          <label for="name">{{$mark->matiere->name}}</label>
                                          <input type="hidden" name="matieres_ids[]" value="{{$mark->matiere->id}}" class="form-control">
                                          <input type="number" name="matieres_marks[]" value="{{$mark->mark}}" class="form-control">
                                        </div>
                                        @endforeach
                                       </div>


                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer pt-2">
                                    <button type="submit" class="btn btn-primary mr-3">حفظ</button>
                                </div>
                                </form>
                        </div>
                        <div class="modal-footer">

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
  function printtag(tagid) {
  var hashid = "#"+ tagid;
  var tagname =  $(hashid).prop("tagName").toLowerCase() ;
  var attributes = "";
  var attrs = document.getElementById(tagid).attributes;
    $.each(attrs,function(i,elem){
      attributes +=  " "+  elem.name+" ='"+elem.value+"' " ;
    })


  var divToPrint= $(hashid).html() ;
  var head = "<html dir='rtl'><head>"+ $("head").html() + "</head>" ;
  var allcontent = head + "<body  onload='window.print()' >"+ "<" + tagname + attributes + ">" +  divToPrint + "</" + tagname + ">" +  "</body></html>"  ;

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write(allcontent);
  newWin.document.close();
 // setTimeout(function(){newWin.close();},10);
}
function printtagAndDisplay(tag){
  $('#'+tag).css('opacity',1)
  printtag(tag);
}
</script>
@endsection
@endsection