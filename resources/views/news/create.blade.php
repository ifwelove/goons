@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="{{ URL::asset('assets/libs/bootstrap-datetimepicker/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/libs/summernote/summernote.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div id="news">
    <news-form></news-form>
</div>
@endsection

@section('script')
@endsection

@section('script-bottom')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-datetimepicker/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ URL::asset('assets/libs/summernote/summernote.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/summernote/summernote-cleaner.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/lang/summernote-zh-TW.min.js"></script>
<script src="{{ URL::asset('js/news.js') }}"></script>
@endsection
