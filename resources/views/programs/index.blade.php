@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
@endsection

@section('content')
    <div id="programs">
        <program></program>
    </div>
@endsection

@section('script')
@endsection

@section('script-bottom')
    <script src="{{ URL::asset('js/programs.js') }}"></script>
@endsection
