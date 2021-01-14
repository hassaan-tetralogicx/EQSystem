@extends('layouts.app')

@section('content')
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-block nk-block-middle nk-auth-body  wide-xs">

                    <div class="card card-bordered">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h5 class="nk-block-title"><strong>Reset password</strong></h5>
                                    <div class="nk-block-des">
                                        <small>Forgot password? We’ll email you instructions to reset your password.</small>
                                    </div>
                                </div>
                            </div>
                            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="email">Email Address</label>
                            </div>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">Send Reset Link</button>
                        </div>
                    </form>
                        <div class="form-note-s2 text-center pt-4">
                            <a href="{{ route('login') }}"><strong>Return to login</strong></a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>

@endsection
