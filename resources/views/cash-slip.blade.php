<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TISs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
 
        body {
            font-family: "THSarabunNew";
        }

        td {
            padding: 0px !important;
            margin: 0px  !important;
        }
        table td, table th
        {
            padding: 0px !important;
            margin: 0px  !important;
        }

    </style>
</head>

<body>
    <div>
        <table style="width: 100%;">
            <thead>
                <tr>
                <th style="text-align: center;padding: .0rem !important;" colspan="6">
                    <span style="font-size:20px;font-weight:bold">{{$title}}</span>
                    <span style="font-size:20px;font-weight:bold">(วันที่ : {{$startDate}} - {{$endDate}})</span>
                </th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table> 
    </div>
    <br />
    <div>
        <table class="table table-bordered" cellpadding = "0" cellspacing = "0">
            <thead>
            <tr>
                <th style="text-align: left;padding: .1rem !important;
                font-weight:bold;text-align:center;background-color:#48dbfb">
                    ลำดับ
                </th>
                <th style="text-align: left;padding: .1rem !important;
                font-weight:bold;text-align:center;background-color:#48dbfb">
                    หน่วยงาน
                </th>
                <th style="text-align: left;padding: .1rem !important;
                font-weight:bold;text-align:center;background-color:#48dbfb">
                    พนักงาน/รปภ.
                </th>
                <th style="text-align: left;padding: .1rem !important;
                font-weight:bold;text-align:center;background-color:#48dbfb">
                    เลขบัญชี
                </th>
                <th style="text-align: left;padding: .1rem !important;
                font-weight:bold;text-align:center;background-color:#48dbfb">
                    จำนวนวัน
                </th>
                <th style="text-align: left;padding: .1rem !important;
                font-weight:bold;text-align:center;background-color:#48dbfb">
                    จำนวนเงิน
                </th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            @foreach ($detail as $detailItem)
            <?php $i++; ?>
                <tr>
                    <td style="padding: .2rem !important;text-align:center">
                        {{$i}}
                    </td>
                    <td style="padding: .2rem !important;">
                        {{$detailItem['customerName']}}
                    </td>
                    <td style="padding: .2rem !important;">
                        {{$detailItem['employeeName']}}
                    </td>
                    <td style="padding: .2rem !important;">
                        {{$detailItem['bankDetail']}}
                    </td>
                    <td style="padding: .2rem !important;">
                        @foreach ($detailItem['day'] as $dayItem)
                        <div>
                            <span style="font-weight:bold">{{$dayItem['date']}}</span>&nbsp;
                            <span style="font-weight:bold">จ่าย: </span><span>{{$dayItem['paidDate']}}</span>
                        </div>
                        @endforeach
                    </td>
                    <td style="padding: .2rem !important;text-align:right">
                        <?php echo number_format($detailItem['paiTotal'],2); ?>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>