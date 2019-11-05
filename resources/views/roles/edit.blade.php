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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('backend.setting.role') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('backend.edit.role') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('backend.edit.role') }}</h4>
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
                    <p class="sub-header"></p>
                    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'class' => 'parsley-form', 'method' => 'PUT')) }}
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">
                            {{ __('backend.role') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            {{ Form::text('name', null, array('required' => 'true',  'id' => 'role', 'class' => 'form-control', 'placeholder' => __('backend.role'))) }}
                        </div>
                    </div>

                    @if(!$permissions->isEmpty())
                        <div class="form-group row">
                            <label for="roles" class="col-sm-2 col-form-label">
                                {{ __('backend.permission') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                @foreach ($permissions as $permission)
                                    <div class="checkbox checkbox-primary">
                                        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions, array('id' => $permission->id)) }}
                                        {{Form::label($permission->id, ucfirst($permission->slug) . '(' . ucfirst($permission->name) . ')') }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <div class="col-sm-12 offset-sm-4">
                            {{ Form::submit(__('backend.create'), array('class' => 'btn btn-primary waves-effect waves-light mr-1')) }}
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
