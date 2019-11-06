@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('backend.setting.system') }}</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('backend.setting.account') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('backend.list.account') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('backend.list.account') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    編輯推播
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card bg-white">
                    <div class="card-body">
                        <h5 class="header-title"></h5>
                        <p class="sub-header"></p>
                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('backend.username') }}</th>
                                    <th>{{ __('backend.role') }}</th>
                                    <th>{{ __('backend.created_at') }}</th>
                                    <th>{{ __('backend.operation') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                    </div> <!-- end card-body -->
                    <div class="card-body">
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
    </div><!-- container -->
@endsection

@section('script')
    <script>
        $('.confirm').click(function (e) {
            e.preventDefault();

            var title = "{{ __('backend.message.are_you_sure') }}";
            var text = "{!!  __('backend.message.you_wont_be_able_to_revert_this') !!}";
            var confirmButtonText = "{{ __('backend.yes') }}";
            var cancelButtonText = "{{ __('backend.no') }}";
            var button = $(this);
            var form = button.closest('form');

            Swal.fire({
                title: title,
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: cancelButtonText,
                confirmButtonText: confirmButtonText
            }).then(function (result) {
                if (result.value) {
                    form.submit();
                }
            });
        });
    </script>
@endsection

@section('script-bottom')
    <!-- init js -->
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Sweet alert init js-->
    <script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
    <!-- Table Editable plugin-->
    <script src="{{ URL::asset('assets/libs/jquery-tabledit/jquery-tabledit.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/tabledit.init.js') }}"></script>
    <!-- Table editable init-->
@endsection
