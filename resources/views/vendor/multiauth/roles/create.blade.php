{{-- @extends('multiauth::layouts.app')  --}}
@extends('admin.layouts.app')
@section('content')
<div class="content p-md-4">
    <div class="container-fluid ">
        <div class="col-md-10 col-md-offset-2">
            <div class="card ">
                <div class="card-header bg-info text-white">
                    إضافة دور
                </div>

                <div class="card-body">
    @include('multiauth::message')
                    <form action="{{ route('admin.role.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="role">اسم الدور</label>
                            <input type="text" placeholder="اسم الدور" name="name" class="form-control" id="role" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">تأكيد</button>
                        <a href="{{ route('admin.roles') }}" class="btn btn-sm btn-danger pull-left">رجوع</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection