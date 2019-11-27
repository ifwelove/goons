@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div id="categories">
    <categories-form :is-edit="true" :category-id="{{ $id }}"></categories-form>
</div>
@endsection

@section('script')
@endsection

@section('script-bottom')
<script src="{{ URL::asset('js/categories.js') }}"></script>
@endsection
