@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
@endsection

@section('content')
    <div id="program">
        <program-index></program-index>
    </div>
@endsection

@section('script')
@endsection

@section('script-bottom')
    <script src="{{ URL::asset('js/program.js') }}"></script>
@endsection
