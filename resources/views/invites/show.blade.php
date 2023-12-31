<style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        font-size: 12px;
    }

    .page {
        background-image-resize: 6;
        height: 100%;
    }

    .address-bar {
        padding: 40px 75px 10px;
        line-height: 1.7em;
        height: 68px;
    }

    .asset-heading {
        padding-right: 42px;
        color: #8d8d8d;
        font-family: oswald, sans-serif;
    }

    table.summary-table {
        background-color: #d7d7d7;
        width: 100%;
        padding: 10px;
    }

    table.summary-table td {
        padding: 2px 15px;
    }

    table.wrapper-table th {
        color: #f7fafc;
        padding: 8px 35px;
        background-color: #383838;
    }

    table.wrapper-table td, p.footnote {
        padding: 3px 35px;
        font-size: 11px;
        /*background-color: #f5f5f5;*/
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .text-white {
        color: white;
    }

    .bg-gray-50 {
        background-color: #f5f5f5
    }

    .bg-white {
        background-color: #ffffff;
    }

    .border-b-white {
        border-bottom: 2px solid #fff
    }

    .border-b-dark {
        border-bottom: 1px solid #999
    }
</style>


<body>
<div class="page" style="background-image: url({{ asset($invite->category . '.jpg') }});">
    <div style="text-align: center; padding-top: 390px">
        <h1 style="color: {{ $invite->category === 'VVIP' ? '#b2883d' : '#777' }}; font-family: 'Times New Roman'">
            {{ strtoupper($invite->name) }}
        </h1>

        <div style="">
            <img
                style="margin-top: 70px; border: 1px solid #cccccc"
                src="https://chart.googleapis.com/chart?cht=qr&chl={{ route('invites.verify', $invite) }}&chs=170x170&choe=UTF-8&chld=L|0"
            />
        </div>
    </div>
</div>
</body>
