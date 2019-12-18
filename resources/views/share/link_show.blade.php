<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
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
<a href="https://febctw.com/{{ $programType }}/{{ $categoryId }}/{{ $programId }}">點擊</a>
<a href="https://febctw.com/share/{{ $programType }}/{{ $categoryId }}/{{ $programId }}">點擊</a>
</body>
{{--<script--}}
{{--        src="https://code.jquery.com/jquery-3.4.1.min.js"--}}
{{--        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="--}}
{{--        crossorigin="anonymous"></script>--}}
<script>
    // $(document).ready(function () {
    //     var txt;
    //     var r = confirm("Press a button!");
    //     if (r == true) {
    //         $('#aaa').get(0).click();
    //         txt = "You pressed OK!";
    //     } else {
    //         txt = "You pressed Cancel!";
    //     }
    //     // $('#aaa').get(0).click();
    // });
</script>
</html>
