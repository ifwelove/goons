<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <title>{{ env('APP_NAME')  }} - {{ env('APP_SLOGAN') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  @include('layouts.head')
</head>

<body>
  <div id="if_need_loader" style="display:none;">
    <div id="preloader">
      <div id="status">
        <div class="bouncingLoader">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
  </div>

  <div id="wrapper">
    @include('layouts.header')
    @include('layouts.sidebar')

    <div class="content-page">
      <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
          @yield('breadcrumb')
          @include('layouts.notification')
          @yield('content')
        </div>
      </div>

{{--      @include('layouts.footer')--}}
    </div>
  </div>

{{--  @include('layouts.rightbar')--}}
  <!-- Center modal -->
  <div class="modal fade bs-example-modal-center" id="timeOutModal" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myCenterModalLabel">Center modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          ...
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  @include('layouts.footer-script')
</body>

</html>
