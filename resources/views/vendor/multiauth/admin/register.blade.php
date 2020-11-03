{{-- @extends('multiauth::layouts.app') --}}
@extends('admin.layouts.app')
@section('content')
<div class="content p-md-4">
    <div class="container-fluid ">
        <div class="col-md-10 col-md-offset-2">
            <div class="card panel-default">
                <div class="card-header bg-primary text-white">
                   تسجيل أدمن جديد
                </div>
                <div class=" card-body">
     @include('multiauth::message')
                    <form method="POST" class="form-horizontal" action="{{ route('admin.register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row text-center">
                            <label for="name" class="col-md-4 control-label">الاسم</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row text-center">
                            <label for="email" class="col-md-4 control-label">البريد الالكتروني</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row text-center">
                            <label for="password" class="col-md-4 control-label">كلمة السر</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <label for="password_confirmation" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <label for="role_id" class="col-md-4 control-label">الدور</label>

                            <div class="col-md-6">
                                <select name="role_id[]" id="role_id" class="form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}" multiple>
                                    <option selected disabled>اختر الدور</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row text-center ">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    إضافة
                                </button>

                                <a href="{{ route('admin.show') }}" class="btn btn-danger btn-sm float-left">
                                    رجوع
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection