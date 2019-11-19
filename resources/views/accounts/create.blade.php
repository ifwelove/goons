@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div id="accounts">
    <account-form></account-form>
</div>
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title"></h4>
                    <p class="sub-header">
                    </p>
                    {{ Form::open(array('url' => 'accounts', 'class' => 'parsley-form')) }}
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">
                            姓名
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" required class="form-control" id="name" placeholder="姓名">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">
                            帳號
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="email" required class="form-control" id="email" placeholder="帳號">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">
                            密碼
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="password" required class="form-control" id="password" placeholder="密碼">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label">
                            權限設定
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            @foreach ($roles as $role)
                                <div class="checkbox checkbox-primary">
                                    {{Form::checkbox('roles[]',  $role->id, false, array('id' => $role->id)) }}
                                    {{Form::label($role->id, ucfirst($role->slug) . '(' . ucfirst($role->name) . ')') }}
                                </div>
                            @endforeach
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
    </div> -->
@endsection

@section('script')
@endsection

@section('script-bottom')
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('js/accounts.js') }}"></script>
@endsection
