@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/libs/bootstrap-datetimepicker/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div id="pushes">
    <pushes-form></pushes-form>
</div>
@endsection

@section('script')
@endsection

@section('script-bottom')
<script src="{{ URL::asset('assets/libs/bootstrap-datetimepicker/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('js/pushes.js') }}"></script>
@endsection
