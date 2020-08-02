@extends('layouts.auth')
@php($title = "Login")
@section('content')
<h3 class="">Log In to <a href="{{ route('home') }}"><span class="brand-name">{{ config('app.name', 'Laravel') }}</span></a></h3>
<p class="signup-link">New Here? <a class="text-warning" href="{{ route('register') }}">Create an account</a></p>
<form class="text-left" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form">
        <div id="username-field" class="field-wrapper input">
            <span class="text-warning" data-feather="user"></span>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div id="password-field" class="field-wrapper input mb-2">
            <span class="text-warning" data-feather="lock"></span>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Account Password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="d-sm-flex justify-content-between">
            <div class="field-wrapper toggle-pass">
                <p class="d-inline-block">Show Password</p>
                <label class="switch s-warning">
                    <input type="checkbox" id="toggle-password" class="d-none">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="field-wrapper">
                <button type="submit" class="btn bg-dark btn-block">
                    {{ __('Login') }}
                </button>
            </div>
        </div>

        <div class="field-wrapper text-center keep-logged-in">
            <div class="n-chk new-checkbox checkbox-outline-primary">
                <label class="new-control new-checkbox checkbox-outline-warning">
                    <input class="new-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="new-control-indicator"></span>Keep me logged in
                </label>
            </div>
        </div>

        <div class="field-wrapper">
            @if (Route::has('password.request'))
            <a  class="text-warning forgot-pass-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </div>
    </div>
</form>

<p class="terms-conditions">Read our <a class="text-warning" href="{{ url('cookies') }}" target="_blank">Cookie Preferences</a> and <a class="text-warning" href="{{ url('privacy') }}" target="_blank">Privacy Policy</a>.</p>

@endsection
