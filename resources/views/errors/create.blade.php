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
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Welcome !</h4>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ env('APP_NAME') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Table Editable</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Table Editable</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class='col-lg-4 col-lg-offset-4'>
            <h1>
                <center>
                    401<br>
                    ACCESS DENIED
                </center>
            </h1>
        </div>
    </div> <!-- container -->
@endsection

@section('script')

@endsection

@section('script-bottom')
    <!-- init js -->
    <!-- Table Editable plugin-->
    <script src="{{ URL::asset('assets/libs/jquery-tabledit/jquery-tabledit.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/tabledit.init.js') }}"></script>
    <!-- Table editable init-->
@endsection
