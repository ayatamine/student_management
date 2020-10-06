@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center text-right">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info" ><h3 class="m-0 text-white" >{{ __('الحساب معلق حاليا') }}</h3></div>

                <div class="card-body">
                    <h5><strong class="">
                        @if (Auth::check())
                                {{Auth::user()->name}}
                        @endif
                        </strong>
                        : مرحبا
                    </h5>
                    <h5>{{ __('حسابك معلق الى حين سيتم ابلاغك عن طريق البريد الالكتروني بمجرد التأكد') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
