<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }

        html {
            font-size: 10px;
        }

        body {
            margin: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.2;
            color: #000;
            position: relative;
            overflow-x: hidden;
            max-width: 700px;
            margin: 0 auto;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0;
        }

        ol,
        ul,
        dl {
            list-style-type: none;
            margin: 0;
            padding-left: 0;
        }

        b,
        strong {
            font-weight: bold;
        }

        a {
            background-color: transparent;
            color: inherit;
            text-decoration: none;
        }

        img {
            vertical-align: middle;
            border-style: none;
            max-width: 100%;
            height: auto;
        }

        table {
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
            text-align: -webkit-match-parent;
        }

        input,
        button,
        select,
        optgroup,
        textarea {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        button,
        input {
            overflow: visible;
        }

        button,
        select {
            text-transform: none;
        }

        select {
            word-wrap: normal;
        }

        button,
        [type=button],
        [type=reset],
        [type=submit] {
            -webkit-appearance: button;
        }

        textarea {
            overflow: auto;
            resize: vertical;
        }

        [type=number]::-webkit-inner-spin-button,
        [type=number]::-webkit-outer-spin-button {
            height: auto;
        }

        [type=search] {
            outline-offset: -2px;
            -webkit-appearance: none;
        }

        [type=search]::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        [hidden] {
            display: none !important;
        }

        .aligncenter {
            text-align: center;
        }

        .alignright {
            text-align: right;
        }

        .alignleft {
            text-align: left;
        }

        img.aligncenter {
            display: block;
            margin: auto;
        }

        img.alignright {
            display: block;
            margin-left: auto;
        }

        img.alignleft {
            display: block;
            margin-right: auto;
        }

        .p-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
            padding: 2rem;
        }

        .p-header__info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .p-header__info img {
            width: 80px;
        }

        .p-header__ticked__number {
            font-size: 15px;
        }

        .p-header__logo {
            width: 150px;
        }

        table tr th,
        table tr td {
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <header>
        <table style="width: 100%;">
            <tr>
                <td width="25%">
                    <table>
                        <tr>
                            <td width="35%" style="padding-right: 10px;"><img src="/qrs/<?php echo $ticketCode; ?>.png" width="80" height="80" alt=""></td>
                            <td width="65%"><span style="font-size: 16px;">Bắt đầu<br><strong><?php echo $ticket_time; ?><br><?php echo $ticket_day; ?>.</strong></span></td>
                        </tr>
                    </table>
                </td>
                <td width="50%" align="center">
                    <table>
                        <tr>
                            <td>
                                <p>Vé điện tử</p>
                                <p style="font-size: 16px;"><strong>#<?php echo $ticket_code; ?></strong></p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="25%" align="right">
                    <table>
                        <tr>
                            <td><img src="/assets/images/pm-logo.png" width="150" alt=""></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </header>
    <main>
        <table width="100%">
            <tr>
                <td width="30%"><img src="/assets/images/download.png" width="269" height="269" alt=""></td>
                <td width="60%">
                    <table width="100%">
                        <tr>
                            <td colspan="2">
                                <p><strong>Mùa đông Moscow - <?php echo $event_name; ?><br><?php echo $eventAddress; ?><br>Bắt đầu từ <?php echo $event_time; ?></strong></p>
                            </td>
                        </tr>
                        <tr>
                            <th>Mã vé : </th>
                            <td><?php echo $ticket_code; ?></td>
                        </tr>
                        <tr>
                            <th>Hạng vé : </th>
                            <td><strong><?php echo $ticket_name; ?></strong></td>
                        </tr>
                        <tr>
                            <th>Mã số ghế : </th>
                            <td><strong><?php echo $seat_code; ?></strong></td>
                        </tr>
                        <tr>
                            <th>Tên nguời mua : </th>
                            <td><strong><?php echo $cname; ?></strong></td>
                        </tr>
                        <tr>
                            <th>Email nguời mua : </th>
                            <td><strong><?php echo $cemail; ?></strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="margin-top: 8px;">
            <p style="border: 1px solid #000; border-radius: 8px; font-size: 14px;">
                <span style="color: red;">Mã số vé của bạn : </span><strong><?php echo $ticket_code; ?></strong>
            </p>
        </div>
        <div style="margin-top: 8px; border: 1px solid #000; border-radius: 8px; font-size: 14px;">
            <p style="color: red;" style="padding: 4px; margin: 0; color:red"> Chính sách và hướng dẫn :</p>
            <p> Chính sách hủy đổi: Vé không được hoàn hoặc đổi sau khi mua.<br> Hướng dẫn sử dụng:<br> Vui lòng in vé này hoặc trình bày qua thiết bị di động tại cửa vào.<br> Mang theo giấy tờ tùy thân nếu được yêu cầu.<br> Hướng dẫn sử dụng:<br> Vui lòng in vé này hoặc trình bày qua thiết bị di động tại cửa vào.</p>
        </div>
        <div style="margin-top: 8px; border: 1px solid #000; font-size: 14px;">
            <p style="color: red;"> Thông tin hỗ trợ:</p>
            <p> Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ: Số điện thoại / Whatsapp:<br>+7 (995) 720‑49‑63 - Masha<br>+7 (977) 559-52-88 - A.Cường<br> Email: <a style="color:#000" href="mailto:info@concertvn.ru">info@concertvn.ru</a></p>
        </div>
    </main>

    <div style="text-align: center;">
        <img src="/qrs/<?php echo $ticketCode; ?>.png" width="200" alt="">
    </div>
    <div style="text-align: center;">
        <img src="/assets/images/pm-logo.png" width="100" alt="">
    </div>

</body>

</html>