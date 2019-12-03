@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div id="news">
    <news></news>
</div>
@endsection

@section('script')
@endsection

@section('script-bottom')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('js/news.js') }}"></script>
@endsection
