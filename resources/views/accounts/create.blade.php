@extends('layouts.master')

@section('css')

@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('backend.setting.system') }}</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('backend.setting.account') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('backend.create.account') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('backend.create.account') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title"></h4>
                    <p class="sub-header">
                    </p>
                    {{ Form::open(array('url' => 'accounts', 'class' => 'parsley-form')) }}
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">
                                {{ __('backend.account') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="username" required class="form-control" id="username" placeholder="{{ __('backend.account') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roles" class="col-sm-2 col-form-label">
                                {{ __() }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                @foreach ($roles as $role)
                                    <label for="{{ $role->name }}" class="col-form-label">
                                        {{ ucfirst($role->name) }}
                                    </label>
                                    <input type="radio" name="roles" id="{{ $role->name }}">
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">
                                密碼
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input id="password" type="password" name="password" placeholder="密碼" required class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirmPassword" class="col-sm-2 col-form-label">
                                重複密碼
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input id="confirmPassword" name="confirm_password" data-parsley-equalto="#password" type="password" required placeholder="重複密碼" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="companyTaxIdNumber" class="col-sm-2 col-form-label">
                                公司統一編號
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="company_tax_id_number" required class="form-control" id="companyTaxIdNumber" placeholder="公司統一編號">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="companyName" class="col-sm-2 col-form-label">
                                公司名稱
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input name="company_name" type="text" required class="form-control" id="companyName" placeholder="公司名稱">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="companyAddr" class="col-sm-2 col-form-label">
                                公司地址
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="company_addr" required class="form-control" id="companyAddr" placeholder="公司地址">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="personPhone" class="col-sm-2 col-form-label">
                                聯絡人電話
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="person_phone" required class="form-control" id="personPhone" placeholder="聯絡人電話">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="personMail" class="col-sm-2 col-form-label">
                                聯絡人信箱
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="email" name="person_mail" required parsley-type="email" class="form-control" id="personMail" placeholder="聯絡人信箱">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dealline" class="col-sm-2 col-form-label">
                                餘額提醒設定
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="dealline" required class="form-control" id="dealline" placeholder="餘額提醒設定">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 offset-sm-4">
                                {{ Form::submit('新增', array('class' => 'btn btn-primary waves-effect waves-light mr-1')) }}
                                {{ Form::reset('取消', array('class' => 'btn btn-secondary waves-effect waves-light')) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection

@section('script-bottom')
    <!-- init js -->
    <!-- Validation js (Parsleyjs) -->
    <script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <!-- validation init -->
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
@endsection
