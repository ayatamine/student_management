@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="login-form">
    <form method="POST" action="{{ route('register') }}">
        @csrf
      <div class="top">
        <h1>Register</h1>
        <h4>Join us now !</h4>
      </div>
      <div class="form-area">
        <div class="group">
          <input placeholder="Full Name"
          id="name" type="text" class="form-control @error('full_name') is-invalid @enderror"
           name="name" required  value="{{ old('name') }}" autofocus >
          <i class="fa fa-user"></i>
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="group">
          <input placeholder="E-mail"
          id="email" type="email" class="form-control @error('email') is-invalid @enderror"
           name="email"
           value="{{ old('email') }}" required autocomplete="email" >
          <i class="fa fa-envelope-o"></i>
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="group">
          <input placeholder="Password"
          id="password" type="password" class="form-control @error('password') is-invalid @enderror"
           name="password" required autocomplete="new-password">
          <i class="fa fa-key"></i>
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="group">
          <input placeholder="Password again" id="password-confirm" type="password" class="form-control"
          name="password_confirmation" required autocomplete="new-password">
          <i class="fa fa-key"></i>
        </div>
        <button type="submit" class="btn btn-default btn-block">REGISTER NOW</button>
      </div>
    </form>
    <div class="footer-links row">
      <div class="col-xs-6"><a  href="{{ route('register') }}"><i class="fa fa-sign-in"></i> Login</a></div>
      <div class="col-xs-6 text-right">
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}"><i class="fa fa-lock"></i> Forgot password</a>
        @endif
      </div>
    </div>
</div>

@endsection
