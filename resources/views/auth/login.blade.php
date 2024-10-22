@extends('auth.dashboard')
@section('content')

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <div class="logo-container">
                    <img src="{{ asset('image/logo.png') }}" id="my-img" alt="logo" class="logo-container-img">
                </div>
                <a href="/" class="h3 no-underline"><b>{{ config('app.name') }}</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg text-lg">Sign in to start your session</p>
                <form action="{{route('login-main')}}" method="POST" class="email_password_input">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                            <span class="fs-6 text-danger  d-block">{{ $message }}</span>
                        @enderror

                    <div class="input-group mb-3">
                        <input id="password" class="form-control " type="password" name="password" required
                            autocomplete="current-password">
                        <div class="input-group-append ">
                            <div class="input-group-text">
                                <span class="fas fa-lock "></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                    <span class="fs-6 text-danger  d-block">{{ $message }}</span>
                @enderror

                    <div class="row mb-3 row-column">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember" class="me-2">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary l">Sign In</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="">I forgot my password</a>
                </p>

            </div>
        </div>
    </div>
@endSection
