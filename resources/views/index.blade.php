@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ env('APP_NAME') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('backend.dashboard') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('backend.message.welcome') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
@endsection

@section('content')
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection
