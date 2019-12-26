<!doctype html>
<html lang="en">
<head>
    {{--    <meta charset="utf-8"/>--}}
    {{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
    {{--    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>--}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>

        img {
            width: 100% !important;
        }
        .container-fluid {
            padding-right:0;
            padding-left:0;
            margin-right:auto;
            margin-left:auto
        }
        #template-body {
            font-family: Microsoft JhengHei !important;
        }

        #template-date {
            padding-top: 30px;
            padding-bottom: 4px;
            font-size: 14px;
            color: #FF785C;
            line-height: 20px;
            font-weight: bold;
        }

        #template-date p {
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 4px;
            margin: 0;
        }

        #template-title {
            font-size: 20px;
            color: #0A0B0E;
            line-height: 28px;
            font-weight: bold;
        }

        #template-title p {
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 20px;
            margin: 0;
        }

        #template-content {
            font-size: 16px;
            color: rgba(10, 11, 14, 0.70);
            line-height: 22px;
            font-weight: normal;
            word-break: break-all;
        }

        #template-content img {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        #template-content b {
            font-size: 16px;
            color: rgba(10, 11, 14, 0.80);
            line-height: 22px;
            font-weight: normal;
        }

        #template-content p{
            padding-left: 20px !important;
            padding-right: 20px !important;
            margin: 0;
        }

        #template-content a {
            font-size: 16px;
            color: #FF785C;
            line-height: 22px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="container-fluid p-0">
    <div class="row no-gutters" id="template-body">
        <div class="col-12" id="template-date"><p>{{ $dateFormat }}</p></div>
        <div class="col-12" id="template-title"><p>{{ $title }}</p></div>
        <div class="col-12" id="template-content">{!! $description !!}</div>
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
<script>
    $(document).ready(function () {
        $.each($('#template-content p'), function (index, item) {
            if ($(item).children('img').length > 0) {
                $(item).css("padding", "0px");
            }
        });
    });
</script>
</html>
