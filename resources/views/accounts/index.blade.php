@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div id="accounts">
    <account></account>
</div>
@endsection

@section('script')
@endsection

@section('script-bottom')
<script src="{{ URL::asset('js/accounts.js') }}"></script>
@endsection
