<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f075;
}
.main-body {
    padding: 15px;
}
.main-breadcrumb{box-shadow: 0px 1px 1px 0 #c7c7c7}

.nav-link {
    color: #4a5568;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
.content-label{    color: #000000cc;
    font-weight: bold;}
.content-value{
    color: #888da8
}
    </style>
</head>
<body>

<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row gutters-sm">
        <div class="col-md-4 d-none d-md-block">
          <div class="card">
            <div class="card-body">
              <nav class="nav flex-column nav-pills nav-gap-y-1">
                <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Profile Information
                </a>
                <a href="#account" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <img src="{{asset('img/absence.png')}}" height="20" width="20" class="feather feather-user " style="margin-right: 0.8rem;opacity:0.7" alt="absence">My Absences
                </a>
                <a href="#security" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield mr-2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>My Marks
                </a>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"
                              class="nav-item nav-link has-icon nav-link-faded">
                    <img src="{{asset('img/logout.png')}}" height="20" width="20" class="feather feather-user " style="margin-right: 0.8rem;opacity:0.7" alt="logout">Log Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header border-bottom mb-3 d-flex d-md-none">
              <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                <li class="nav-item">
                  <a href="#profile" data-toggle="tab" class="nav-link has-icon active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
                </li>
                <li class="nav-item">
                  <a href="#account" data-toggle="tab" class="nav-link has-icon"><img src="{{asset('img/absence.png')}}" height="20" width="20" class="feather feather-user " style="margin-right: 0.8rem;opacity:0.7" alt="absence"></a>
                </li>
                <li class="nav-item">
                  <a href="#security" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></a>
                </li>
                <li class="nav-item">
                  <a href="{{route('logout')}}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" data-toggle="tab" class="nav-link has-icon"><img src="{{asset('img/logout.png')}}" height="20" width="20" class="feather feather-user " style="margin-right: 0.8rem;opacity:0.7" alt="logout"></a>
                </li>
              </ul>
            </div>
            <div class="card-body tab-content">
              <div class="tab-pane active" id="profile">
                <h6>PROFILE INFORMATIONS</h6>
                <hr>

                <div class="row">
                    <div class="form-group col-sm-6 col-md-4">
                      <label for="fullName" class="content-label">Full Name</label>
                      <h6 class="content-value">{{$student->name}}</h6>
                    </div>
                    <div class="form-group col-sm-6 col-md-4">
                      <label for="email" class="content-label">E-mail</label>
                      <h6 class="content-value">{{$student->email}}</h6>
                    </div>
                    <div class="form-group col-sm-6 col-md-4">
                      <label for="classes" class="content-label">Class</label>
                      <h6 class="content-value">{{$student->class ? $student->class->name : 'no class yet'}}</h6>
                    </div>
                    <div class="form-group col-sm-6 col-md-4">
                      <label for="classes" class="content-label">Modules Number</label>
                      <h6 class="content-value">{{$student->class ? count($student->class->matieres) : 0}}</h6>
                    </div>
              </div>
              </div>
              <div class="tab-pane" id="account">
                <h6>Class Informations</h6>
                <hr>
                <div class="p-3">
                  <div class="">
                    <div class="row">
                      <div class="form-group col-sm-6 col-md-4">
                        <label for="classes" class="content-label">Studing days number</label>
                        <h6 class="content-value">{{$student->class ? $student->class->studing_day_number : 'not presented yet'}}</h6>
                      </div>
                      <div class="form-group col-sm-6 col-md-4">
                        <label for="classes" class="content-label">Maximum absence number</label>
                        <h6 class="content-value">{{$student->class ? $student->class->max_absence_number : 0}}</h6>
                      </div>
                      <div class="form-group col-sm-6 col-md-4">
                        <label for="classes" class="content-label">Your Absence</label>
                        <h6 class="content-value">{{$student ? $student->absence_number : 0}}</h6>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <h6>My Absence progress</h6>
                  <hr>
                  <div class="progress">
                    @php
                        $absence_percentage = $student->absencePercentage();
                        switch ($absence_percentage) {
                          case ( $absence_percentage > 70) :
                              $progress_color = 'bg-danger';
                            break;
                          case ( $absence_percentage < 70 &&  $absence_percentage > 40) :
                              $progress_color = 'bg-warning';
                            break;

                          default:
                               $progress_color = '';
                            break;
                        }
                    @endphp
                    <div class="progress-bar {{$progress_color}}" role="progressbar" style="width: {{$absence_percentage}}%;" aria-valuenow="{{$absence_percentage}}" aria-valuemin="0" aria-valuemax="100">{{$absence_percentage}}%</div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="security">
                <h6>List of Marks by Modules</h6>
                <hr>
                <table class="table table-striped" id="marks">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Module</th>
                        <th scope="col">Mark</th>
                        <th scope="col">cofficient</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $sum = 0;
                      @endphp
                      @forelse ($student->marks as $key => $m)
                      <tr>
                        <th scope="row">{{$key++}}</th>
                        <td>{{$m->matiere->name}}</td>
                        <td><strong class="text-success">{{$m->mark}}</strong> / {{$m->matiere->total}}</td>
                        <td>{{$m->matiere->cofficient}}</td>
                        <td>{{$m->mark * $m->matiere->cofficient}}</td>
                      </tr>

                      @php
                          $sum+=$m->mark;
                      @endphp
                      @empty
                            <td colspan="4">no mark founded!</td>
                      @endforelse
                      <tr>
                        <th scope="row">#</th>
                        <td colspan="2"></td>
                        <td><strong>{{$student->marksAverage()['cofficient_sum']}}</strong></td>
                        <td>
                          <strong class={{$student->marksAverage()['result'] > 10 ? 'text-success' : 'text-danger'}}>
                            {{$student->marksAverage()['result']}}</strong>
                        </td>
                      </tr>
                    </tbody>
                </table>
                <div class="bg-white p-3 text-center">
                  <button type="button" class="btn btn-warning" onclick="printtag('marks')"
                  ><i class="fa fa-print"></i> طباعة الكشف</button>
                  <button type="button" class="btn btn-info" onclick="printtagAndDisplay('present_certificate')"
                  ><i class="fa fa-print"></i> شهادة الحضور</button>
                  <button type="button" class="btn btn-success" onclick="printtagAndDisplay('success_certificate')"
                  ><i class="fa fa-print"></i> شهادة الاجتياز</button>
                </div>
                <div id="present_certificate" class="text-right" style="opacity: 0">
                  <h5 class="text-center">شهادة حضور</h5>
                  <h6>الى الطالب {{$student->name}}</h6>

                   إن {{$settings->site_name}} تتمنى لك أسمى عبارات التقدير والنجاح في مشوارك وتشكرك على الحضور
                </div>
                <div id="success_certificate"  class="text-right" style="opacity: 0">
                  <h5 class="text-center">شهادة اجتياز</h5>
                  <h6>الى الطالب {{$student->name}}</h6>

                   إن {{$settings->site_name}} تتمنى لك أسمى عبارات التقدير والنجاح في مشوارك وتشكرك على اجتيازك له المرحلة بنجاح
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
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
  $('#'+tag).css('opacity',0)
}

</script>
</body>
</html>