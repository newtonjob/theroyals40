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
<div class="page" style="background-image: url({{ asset(tenant()->domain.'.jpg') }});">
    <div style="text-align: center; padding-top: 400px">
        <h1 style="color: #b79a47; font-family: 'Times New Roman'">
            {{ strtoupper($invite->name) }}
        </h1>

        <div style="">
            <img
                style="margin-top: 100px; border: 1px solid #cccccc"
                src="https://quickchart.io/qr?text={{ route('invites.verify', $invite) }}&size=170&dark=625534"
                alt="code"
            />
        </div>
    </div>
</div>

<pagebreak />

<div
    class="page"
    style="background-image: url({{ asset('palette.jpg') }});"
></div>

</body>
