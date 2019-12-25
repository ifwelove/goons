<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>遠東福音會</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="遠東福音會" name="description"/>
    <meta content="遠東福音會" name="author"/>
    <meta property="og:site_name" content="遠東福音會">
    <meta property="og:title" content="遠東福音會 - {{ $program['anchor'] }} - {{ $program['title'] }}">
    <meta property="og:description" content="{{ $program['title'] }} - {{ $program['sub_title'] }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}/{{ $programType }}/{{ $categoryId }}/{{ $programId }}">
    <meta property="og:locale" content="zh_TW">
    @if ($programType < 1)
        <meta property="og:image" content="{{ config('app.url') }}{{ $program['category']['image'] }}">
        <link rel="image_src" href="{{ config('app.url') }}{{ $program['category']['image'] }}">
    @else
    @endif
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<script language="javascript">
    var URL = document.location.toString();
    var useragent = navigator.userAgent;
    useragent = useragent.toLowerCase();
    {{--setTimeout(function () {--}}
            {{--    window.location.replace("https://febctw.com/{{ $programType }}/{{ $categoryId }}/{{ $program['id'] }}");--}}
            {{--}, 3000);--}}
    if (useragent.indexOf('iphone') != -1) {
        // setTimeout(function () {
        //     window.location.replace("itms-apps://itunes.apple.com/tw/app/apple-store/id1185371908?mt=8");
        // }, 3000);
    } else if (useragent.indexOf('ipad') != -1 || useragent.indexOf('ipod') != -1) {
        // setTimeout(function () {
        //     window.location.replace("itms-apps://itunes.apple.com/tw/app/apple-store/id1185371908?mt=8");
        // }, 3000);
    } else if (useragent.indexOf('android') != -1) {
        // setTimeout(function () {
        //     window.location.replace("market://details?id=tw.com.taishinbank.ccapp");
        // }, 3000);
    } else {
        // PC
    }
</script>
<body>
<div class="container-fluid bg-gray-200">
    <div class="row no-gutters">
        <div class="col-12">
            <div style="height: calc(100vh - 164px);"
                 class="d-flex justify-content-center align-content-center flex-wrap">
                <div>
                    <img src="{{ asset('images/appicon.png') }}" class="rounded mx-auto d-block">
                    <div class="pt-3">精彩內容分享給您</div>
                </div>
            </div>
            <div class="fixed-bottom text-center" style="padding-bottom: 60px;padding-left: 20px;padding-right: 20px;">
                <a href="https://febctw.com/share/{{ $programType }}/{{ $categoryId }}/{{ $programId }}" role="button"
                   aria-pressed="true" class="mb-3 btn btn-primary btn-lg btn-block"
                   style="background-color: #ff785c;border-color: #ff785c;">
                    <span class="d-inline-flex">開啟遠東廣播 APP</span>
                </a>
                <a href="https://febctw.com/share/{{ $programType }}/{{ $categoryId }}/{{ $programId }}" role="button"
                   aria-pressed="true" class="btn btn-outline-primary btn-lg btn-block"
                   style="background-color: #ffffff;border-color: #a1a6b3;color: #a1a6b3">
                    <span class="d-inline-flex">下載遠東廣播 APP</span>
                </a>
            </div>
        </div>
    </div>
</div>
</body>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</html>
