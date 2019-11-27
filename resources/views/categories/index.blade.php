@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div id="categories">
    <categories></categories>
</div>
@endsection

@section('script')
@endsection

@section('script-bottom')
<script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('js/categories.js') }}"></script>
@endsection
