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
                    {{-- <div class="brand-logo pb-4 text-center">
                        <a href="html/index.html" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                            <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                        </a>
                    </div> --}}
                    <div class="card card-bordered">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Sign-In</h4>
                                    {{-- <div class="nk-block-des">
                                        <p>Access the CryptoLite panel using your email and passcode.</p>
                                    </div> --}}
                                </div>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="default-01">Email or Username</label>
                                    </div>

                                        <input type="email" id="email default-01" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Enter your email address or username" required autocomplete="email" autofocus>

                                        {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Passcode</label>
                                        {{-- <a class="link link-primary link-sm" href="html/pages/auths/auth-reset-v2.html">Forgot Code?</a> --}}
                                    </div>
                                    <div class="form-control-wrap">
                                        {{-- <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a> --}}
                                        {{-- <input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> --}}
                                        <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Enter your passcode" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group">

                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                            <div class="form-note-s2 text-center pt-4"> New on our platform? <a href="/register">Create an account</a>
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
<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{ asset('css/bundle.js') }}"></script>
<script src="{{ asset('css/scripts.js') }}"></script>

@endsection

