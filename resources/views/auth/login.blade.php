@extends('layouts.auth')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-wrap p-4 p-md-5">
                <h3 class="text-center mb-4" style="color: #48ABF7">Login</h3>
                <div class="icon d-flex align-items-center justify-content-center" style="background:#48ABF7">
                    <span class="fa fa-user-o"></span>
                </div>
                <form method="POST" action="{{ route('login.custom') }}" class="login-form">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong class="mx-3">Error! Something went wrong</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <input id="email" type="email" placeholder="Email" class="form-control rounded-left @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group d-flex">
                        <input id="password" type="password" placeholder="Password" class="form-control rounded-left @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group d-md-flex">
                        <div class="w-50">
                            <label class="checkbox-wrap" style="color: #48ABF7;">Remember Me
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="w-50 text-md-right">
                            <a href="#" style="color: #48ABF7;">Forgot Password</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn rounded submit p-3 px-5" style="background: #48ABF7; color:white">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection