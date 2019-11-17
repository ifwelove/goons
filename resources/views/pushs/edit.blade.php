@extends('layouts.master')

@section('css')
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
<script src="{{ URL::asset('js/pushes.js') }}"></script>
@endsection
