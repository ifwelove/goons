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
{{--                            <p class="text-muted mb-4 mt-3">{{ __('backend.message.login.title') }}</p>--}}
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
                                <label for="email">{{ __('backend.username') }}</label>
                                <input class="form-control" onkeyup="stoppedTyping()" type="text" id="email" name="email" value="" placeholder="{{ __('backend.message.enter_your_username') }}" autofocus />
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">{{ __('backend.password') }}</label>
                                <input class="form-control" onkeyup="stoppedTyping()" type="password" name="password" id="password" placeholder="{{ __('backend.message.enter_your_password') }}">
                            </div>
                            @if($errors->has('email') || $errors->has('password'))
                                <div class="alert alert-danger bg-white text-danger">帳號、密碼錯誤，請聯絡管理者</div>
                            @endif
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-8">
                                    <div class="kt-checkbox-inline">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" name="remember" value="1"> 保持登入（30 天）
                                            <span></span>
                                        </label>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" id="submit" type="submit">{{ __('backend.login') }}</button>
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
        function stoppedTyping(){
            if(document.getElementById("email").value === "" || document.getElementById("password").value === "") {
                document.getElementById('submit').disabled = true;
            } else {
                document.getElementById('submit').disabled = false;
            }
        }
        $(document).ready(function () {
            stoppedTyping();

            var display = "{{ __('backend.display') }}";
            var none = "{{ __('backend.none') }}";
            var status = true;
        });
    </script>
@endsection
