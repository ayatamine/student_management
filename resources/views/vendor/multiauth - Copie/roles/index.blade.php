{{-- @extends('multiauth::layouts.app') --}}
@extends('admin.layouts.app')
@section('content')
<div class="content p-md-4">
    <div class="container-fluid ">
        <div class="col-md-10 col-md-offset-2">
            @include('multiauth::message')
            <div class="card panel-default">
                <div class="card-header bg-info text-white">
                    الأدوار
                    <span class="pull-left">
                        <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-success">دور جديد</a>
                    </span>
                </div>

                <div class="panel-body">

                    <ol class="list-group">
                        @foreach ($roles as $role)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $role->name }}

                            <span class="badge badge-primary badge-pill">منسوب الى <strong >{{ $role->admins->count() }}</strong> أدمن</span>
                            <div class="pull-right">
                                <a href="{{ route('admin.role.edit',$role->id) }}" class="btn btn-sm btn-primary">تعديل</a>

                                <a href="" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">حدف</a>

                                <form id="delete-form-{{ $role->id }}" action="{{ route('admin.role.delete',$role->id) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form>

                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection