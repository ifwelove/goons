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
                        <li class="breadcrumb-item active">{{ __('backend.edit.account') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('backend.edit.account') }}</h4>
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
                    {{ Form::model($account, array('route' => array('accounts.update', $account->id), 'method' => 'PUT', 'class' => 'parsley-form')) }}
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">
                            {{ __('backend.username') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="username" value="{{ $account->username }}" required class="form-control" id="username" placeholder="{{ __('backend.username') }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label">
                            {{ __('backend.role') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            @foreach ($roles as $role)
                                <div class="radio radio-primary">
                                    {{ Form::radio('role', $role->id, $account->hasRole($role->name), array('id' => $role->name)) }}
                                    {{ Form::label($role->name, ucfirst($role->name)) }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 offset-sm-4">
                            {{ Form::submit(__('backend.edit'), array('class' => 'btn btn-primary waves-effect waves-light mr-1')) }}
                            {{ Form::reset(__('backend.cancel'), array('class' => 'btn btn-secondary waves-effect waves-light')) }}
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
