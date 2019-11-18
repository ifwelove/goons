@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div id="accounts">
    <account></account>
</div>
@endsection

@section('script')
<script>
    // window.accounts = (JSON.parse('{!! json_encode($accounts) !!}'));
</script>
@endsection

@section('script-bottom')
<script src="{{ URL::asset('js/accounts.js') }}"></script>
@endsection
