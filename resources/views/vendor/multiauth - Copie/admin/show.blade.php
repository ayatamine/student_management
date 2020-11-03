{{-- @extends('multiauth::layouts.app')  --}}
@extends('admin.layouts.app')
@section('content')
<div class="content p-md-4">
    <div class="container-fluid ">
        <div class="col-md-10 col-md-offset-2">
            <div class="card panel-default">
                <div class="card-header bg-info text-white">
                    المجموعات
                    <span class="pull-left">
                        <a href="{{route('admin.register')}}" class="btn btn-sm btn-success">أدمن جديد {{-- {{ ucfirst(config('multiauth.prefix')) }} --}}</a>
                    </span>
                </div>

                <div class="panel-body">

    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($admins as $admin)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $admin->name }}
                            <span class="badge">
                                    @foreach ($admin->roles as $role)
                                        <span class="badge-warning badge-pill ml-2">
                                            {{ $role->name }}
                                        </span> @endforeach
                            </span>
                            <div class="pull-right">
                                <form id="delete-form-{{ $admin->id }}" action="{{ route('admin.delete',[$admin->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form>

                                <a href="{{route('admin.edit',[$admin->id])}}" class="btn btn-sm btn-primary mr-3">تعديل</a>
                                <a href="#" class="btn btn-sm btn-danger mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();">حدف</a>

                            </div>
                        </li>
                        @endforeach @if($admins->count()==0)
                        <p>No {{ config('multiauth.prefix') }} created Yet, only super {{ config('multiauth.prefix') }} is available.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection