@extends('layouts.front')
@section('content')
<style>
    .card-login{
        border-radius: 0;
        box-shadow: 2px 2px 2px 2px #c9bcd2;
        border: none;
    }
    .header-login{
        height: 200px;
        width: 100%;
        background: linear-gradient(120deg, #00e4d0, #5983e8);
    }
    .card-header:first-child {
         border-radius: 0;
    }
    .btn-flat{
        border-radius: 0;
        box-shadow: 0 2px #d0c3d9;
        padding: 3px 20px;
        background: linear-gradient(120deg, #00e4d0, #5983e8);
    }

    .input-material:focus{
        outline: none;
        box-shadow:none;
        border-color:#f11f24;
    }
    .input-material{
        border: none;
        border-bottom: aqua solid 1px;
        border-radius: 0;
    }
</style>
<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-5">
            <div class="card card-login">
                <div class="card-header header-login">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}
                            <div class="col-md-12">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-material"
                                    placeholder="Username"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required autofocus
                                >
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}
                            <div class="col-md-12">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input-material"
                                    placeholder="Password"
                                    name="password"
                                    required
                                >
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
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
                                <button type="submit" class="btn btn-primary btn-flat">
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
</div>
@endsection
