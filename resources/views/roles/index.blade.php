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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('backend.setting.role') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('backend.list.role') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('backend.list.role') }}</h4>
            </div>
        </div>
        <div class="col-12">
            <h1>
                <a class="btn btn-success waves-effect" href="{{ route('roles.create') }}" role="button">
                    {{ __('backend.create.role') }}
                </a>
            </h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="header-title"></h5>
                        <p class="sub-header"></p>
                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead>
                                <tr>
                                    <th>{{ __('backend.role') }}</th>
                                    <th>{{ __('backend.permission') }}</th>
                                    <th>{{ __('backend.operation') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <a class="btn btn-success waves-effect" href="{{ route('roles.edit', $role->id) }}" role="button">
                                                        <i class="fa fa-wrench mr-1"></i>
                                                        {{ __('backend.edit') }}
                                                    </a>
                                                </div>
                                                <div class="col-sm-4">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash mr-1"></i>' . __('backend.delete'), ['type' => 'submit', 'class' => 'btn btn-danger confirm']) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                    </div> <!-- end card-body -->
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
            var text = "{!!  __('backend.message.you_wont_be_able_to_revert_this')  !!}";
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
    <!-- Table Editable plugin-->

    <script src="{{ URL::asset('assets/libs/jquery-tabledit/jquery-tabledit.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/tabledit.init.js') }}"></script>
    <!-- Table editable init-->
@endsection
