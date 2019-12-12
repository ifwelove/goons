<div id="template-body">
    <div id="template-date">{{ $dateFormat }}</div>
    <div id="template-title">{{ $title }}</div>
    <div id="template-content">{!! $description !!}</div>
</div>

<style>
    img {
        width: 100% !important;
    }
    #template-body {
        font-family: Microsoft JhengHei !important;
        padding-left: 20px;
        padding-right: 20px;
    }

    #template-date {
        padding-top: 30px;
        padding-bottom: 30px;
        font-size: 14px;
        color: #FF785C;
        line-height: 20px;
        font-weight: bold;
    }

    #template-title {
        font-size: 20px;
        color: #0A0B0E;
        line-height: 28px;
        font-weight: bold;
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

    #template-content a {
        font-size: 16px;
        color: #FF785C;
        line-height: 22px;
        font-weight: bold;
        text-decoration: underline;
    }
</style>
