{{-- @extends('multiauth::layouts.app') --}}
@extends('admin.layouts.app')
@section('content')
<div class="content p-md-4">
    <div class="container-fluid ">
        <div class="col-md-10 col-md-offset-2">
            <div class="card panel-default">
                <div class="card-header bg-info text-white">
                    تعديل بيانات <strong>{{$admin->name}}</strong>
                </div>


                <div class="card-body">
                    @include('multiauth::message')
                    <form action="{{route('admin.update',[$admin->id])}}" method="post">
                        @csrf @method('patch')
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">الاسم</label>
                            <input type="text" value="{{ $admin->name }}" name="name" class="form-control col-md-6" id="role">
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">البريد الالكتروني</label>
                            <input type="text" value="{{ $admin->email }}" name="email" class="form-control col-md-6" id="role">
                        </div>

                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">الدور</label>

                            <select name="role_id[]" id="role_id" class="form-control col-md-6 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" multiple>
                                <option selected disabled>اختر الدور</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        @if (in_array($role->id,$admin->roles->pluck('id')->toArray()))
                                            selected
                                        @endif >{{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('role_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    تغيير
                                </button>
                                <a href="{{ route('admin.show') }}" class="btn btn-danger btn-sm float-left">رجوع</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
