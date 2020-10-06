@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center text-right">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info" ><h3 class="m-0 text-white" >{{ __('تأكيد البريد الالكتروني') }}</h3></div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('.تم ارسال رمز التحقق مرة اخرى لبريدك الدي سجل به') }}
                        </div>
                    @endif
                    <h5>{{ __('.قبل المواصلة ، قم بتأكيد البريد الالكتروني من الرابط المرسل') }}</h5>
                    <h5>

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn p-0 m-0 align-baseline text-primary p-1">{{ __('انقر هنا لطب رمز اخر') }}</button>.
                        </form>
                        {{ __('إدا لم يصلك أي بريد') }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
