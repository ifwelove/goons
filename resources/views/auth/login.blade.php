@extends('layouts.master-blank')

@section('content')
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <a href="/">
                                {{ env('APP_NAME') }}
                            </a>
                            <p class="text-muted mb-4 mt-3">{{ __('backend.message.login.title') }}</p>
                        </div>
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            <br>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            <br>
                        @endif
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="username">{{ __('backend.username') }}</label>
                                <input class="form-control @if($errors->has('username')) is-invalid @endif" type="text" id="username" name="username" value="flydove" placeholder="{{ __('backend.message.enter_your_username') }}" autofocus />
                                @if($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">{{ __('backend.password') }}</label>
                                <div class="input-group">
                                    <input class="form-control @if($errors->has('password')) is-invalid @endif" type="password" name="password" id="password" value="123456" placeholder="{{ __('backend.message.enter_your_password') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary waves-effect waves-light" id="passwordBtn" type="button">{{ __('backend.display') }}</button>
                                    </div>
                                </div>
                                @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="captcha">{{ __('backend.captcha') }}</label>
                                <div class="row">
                                    <div class="col-8">
                                        <input class="form-control @if($errors->has('captcha')) is-invalid @endif" type="text" name="captcha" id="captcha" placeholder="{{ __('backend.message.enter_your_captcha') }}">
                                        @if($errors->has('captcha'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('captcha') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-2">
                                        <img src="{{ captcha_src() }}" style="cursor: pointer" onclick="this.src='{{ captcha_src() }}'+Math.random()">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit">{{ __('backend.login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            var display = "{{ __('backend.display') }}";
            var none = "{{ __('backend.none') }}";
            var status = true;

            $('#passwordBtn').on('click', function () {
                status = !status;
                var btnText = status ? none : display;
                $(this).text(btnText);
                $('#password').attr('type', status ? "text" : "password");
            });
        });
    </script>
@endsection
