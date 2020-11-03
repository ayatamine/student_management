{{-- @extends('multiauth::layouts.app') --}}
@extends('admin.layouts.app')
@section('content')
<div class="content p-md-4">
    <div class="container-fluid ">
        <div class="col-md-10 col-md-offset-2">
            <div class="card ">
                <div class="card-header bg-info text-white">
                    تعديل دور
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.role.update', $role->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="form-group">
                            <label for="role">اسم الدور</label>
                            <input type="text" autofocus value="{{ $role->name }}" name="name" class="form-control" id="role">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">تغيير</button>
                        <a href="{{ route('admin.roles') }}" class="btn btn-danger btn-sm pull-left">رجوع</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection