<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <style>
        img {
            width: 100% !important;
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
            padding-left: 20px;
            padding-right: 20px;
        }

        #template-title {
            font-size: 14px;
            color: #0A0B0E;
            line-height: 28px;
            font-weight: bold;
            padding-left: 20px;
            padding-right: 20px;
        }

        #template-content {
            font-size: 16px;
            color: rgba(10, 11, 14, 0.70);
            line-height: 22px;
            font-weight: normal;
        }

        #template-content b {
            font-size: 16px;
            color: rgba(10, 11, 14, 0.80);
            line-height: 22px;
            font-weight: normal;
        }

        #template-content p, #template-content b, #template-content span {
            padding-left: 20px;
            padding-right: 20px;
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
<div id="template-body">
    <div id="template-date">{{ $dateFormat }}</div>
    <div id="template-title">{{ $title }}</div>
    <div id="template-content">{!! $description !!}{!! $description !!}{!! $description !!}{!! $description !!}</div>
</div>
</body>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
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
