<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">خانه</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">تماس</a>
      </li> --}}
    </ul>

    <!-- SEARCH FORM -->
  {{--   <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
                <span class="">{{auth('admin')->user()->name}}</span>
                <i class="fa fa-sort-desc" style="position:relative;top:-3px" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <a href="{{ url('/admin/logout') }}"  onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"
           class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  تسجيل الخروج
                  <span class="float-left text-sm text-danger">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                  </span>
                </h3>
                <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <a href="javascript:void()" data-toggle="modal" data-target="#updateAccount"
           class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  تعديل حسابي
                  <span class="float-left text-sm text-danger">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                  </span>
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>

        </div>
      </li>
     {{--  <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
            <span class="float-left text-muted text-sm">3 دقیقه</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-users ml-2"></i> 8 درخواست دوستی
            <span class="float-left text-muted text-sm">12 ساعت</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-file ml-2"></i> 3 گزارش جدید
            <span class="float-left text-muted text-sm">2 روز</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                class="fa fa-th-large"></i></a>
      </li> --}}
    </ul>
  </nav>
<div class="modal fade" id="updateAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content mt-4">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <form role="form" id="addbf"  method="POST" action="{{route('admin.updateAccount')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body pb-0">
                        <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text"  name="name"  class="form-control" id="name" value="{{auth('admin')->user()->name}}">
                        </div>
                        <div class="form-group">
                        <label for="file_number">البريد الالكتروني</label>
                        <input type="email"  name="email"  class="form-control" id="email" value="{{auth('admin')->user()->email}}">
                        </div>
                        <div class="form-group">
                        <label for="password">كلمة السر الجديدة</label>
                        <input type="password"  name="password"  class="form-control" id="password">
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer pt-0">
                    <button type="submit" class="btn btn-primary mr-3">حفظ</button>
                </div>
                </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>
</div>