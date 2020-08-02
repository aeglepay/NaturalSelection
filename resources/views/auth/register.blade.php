@extends('layouts.auth')
@php($title = 'Register')
@section('content')

<h3 class="">Get started today</h3>
<p class="signup-link">Already have an account? <a class="text-warning" href="{{ route('login') }}">Log in</a></p>
<form class="text-left" method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form">
        <div id="username-field" class="field-wrapper input">
            <span class="text-warning" data-feather="user"></span>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div id="phone-field" class="field-wrapper input">
            <span class="text-warning" data-feather="phone"></span>
            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required autocomplete="phone">

            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div id="email-field" class="field-wrapper input">
            <span class="text-warning" data-feather="mail"></span>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div id="password-field" class="field-wrapper input mb-2">
            <span class="text-warning" data-feather="lock"></span>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Account Password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div id="password-field" class="field-wrapper input mb-2">
            <span class="text-warning" data-feather="lock"></span>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
        </div>

        <div class="field-wrapper terms_condition">
            <div class="n-chk new-checkbox checkbox-outline-warning">
                <label class="new-control new-checkbox checkbox-outline-warning">
                    <input type="checkbox" class="new-control-input">
                    <span class="new-control-indicator"></span><span>I agree to the <a class="text-warning" href="{{ url('terms') }}" target="_blank"> terms and conditions </a></span>
                </label>
            </div>
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
                <button type="submit" class="btn bg-dark btn-block">Get Started!</button>
            </div>
        </div>
    </div>
</form>

<p class="terms-conditions">Read our <a class="text-warning" href="{{ url('cookies') }}" target="_blank">Cookie Preferences</a> and <a class="text-warning" href="{{ url('privacy') }}" target="_blank">Privacy Policy</a>.</p>

@endsection
