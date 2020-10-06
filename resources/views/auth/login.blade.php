@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="login-form">
    <form method="POST" action="{{ route('login') }}">
        @csrf
      <div class="top">

        <img src="{{asset('img').'/'.\App\Setting::first()->logo}}" alt="icon" class="icon">
        <h1>{{\App\Setting::first()->site_name}}</h1>
        <h4>Login to get access</h4>
      </div>
      <div class="form-area">
        <div class="group">
          <input  placeholder="Email"
          id="email" type="email" class="form-control @error('email') is-invalid @enderror"
           name="email"
           value="{{ old('email') }}" required autocomplete="email" autofocus>
          <i class="fa fa-user"></i>
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="group">
          <input placeholder="Password"
          id="password" type="password" class="form-control @error('password') is-invalid @enderror"
           name="password" required autocomplete="current-password">
          <i class="fa fa-key"></i>
          @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="checkbox checkbox-primary">
          <input    type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label for="remember"> Remember Me</label>
        </div>
        <button type="submit" class="btn btn-default btn-block">LOGIN</button>
      </div>
    </form>
    <div class="footer-links row">
      <div class="col-xs-6"><a href="{{ route('register') }}"><i class="fa fa-external-link"></i> Register Now</a></div>
      <div class="col-xs-6 text-right">
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}"><i class="fa fa-lock"></i> Forgot password</a>
        @endif
      </div>
    </div>
  </div>
@endsection
