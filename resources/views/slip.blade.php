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
                    <th style="text-align: left;padding: .0rem !important;" colspan="2"><span style="font-size:20px;font-weight:bold">ใบแจ้งสลิปเงินเดือน (PAY SLIP)</span></th>
                    <th style="text-align: left;padding: .0rem !important;" colspan="2"><span style="font-size:20px;font-weight:bold">บริษัทรักษาความปลอดภัยทีสการ์ด กรุ๊ป จำกัด</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: .0rem !important;">แผนก / Dep.</td>
                    <td style="padding: .0rem !important;">{{$department->name}}</td>
                    <td style="padding: .0rem !important;">ประจำงวด (Peroid)</td>
                    <td style="padding: .0rem !important;">
                        <?php 
                            $startDateSplit = (explode(" ",$slip->peroid_start));
                            echo $startDateSplit[0] ." - ";
                            $endDateSplit = (explode(" ",$slip->peroid_end));
                            echo $endDateSplit[0];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: .0rem !important;">ชื่อ-นามสกุล</td>
                    <td style="padding: .0rem !important;">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td style="padding: .0rem !important;">วันที่จ่าย (Date)</td>
                    <td style="padding: .0rem !important;">{{$slip->payment_date}}</td>
                </tr>
            </tbody>
        </table>
        <br /> 

        <table class="table table-bordered" cellpadding = "0" cellspacing = "0">  
                <tr>
                    <th style="padding-left: .4rem !important;">รายได้ (Income)</th>
                    <th style="padding-left: .4rem !important;">รายการหัก (Deduction)</th>
                    <th colspan="2" style="padding: .0rem !important;"></th>
                </tr>
                <tr>
                    <td style="padding: .0rem !important;">
                  		<table style="width:100%">
                            <tbody>
                                @foreach ($slip->slipItems as $slipItem)
                                    @if ($slipItem->item_type == 'I')
                                    <tr>
                                        <td style="padding-left: .4rem !important;border:0px;">{{$slipItem->item_name}}</td>
                                        <td style="padding-right: .4rem !important;border:0px;text-align:right"><?php echo number_format($slipItem->amount,2) ?></td>
                                    </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td style="padding-left: .4rem !important;border:0px;font-weight:bold">ยอดรวมเงินได้</td>
                                    <td style="padding-right: .4rem !important;border:0px;text-align:right"><?php echo number_format($slip->total_income) ?></td>
                                </tr>
                            </tbody>
                        </table>
                   </td>
					<td style="padding: .0rem !important;">
                  		<table style="width:100%">
                            <tbody>
                                @foreach ($slip->slipItems as $slipItem)
                                    @if ($slipItem->item_type == 'D')
                                    <tr>
                                        <td style="padding-left: .4rem !important;border:0px;">{{$slipItem->item_name}}</td>
                                        <td style="padding-right: .4rem !important;border:0px;text-align:right"><?php echo number_format($slipItem->amount) ?></td>
                                    </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td style="padding-left: .4rem !important;border:0px;font-weight:bold">ยอดรวมเงินหัก</td>
                                    <td style="padding-right: .4rem !important;border:0px;text-align:right"><?php echo number_format($slip->total_deduction) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td colspan="2" style="padding: .0rem !important;">
                        <table style="width:100%">
                                <tbody>
                                    <tr>
                                        <td style="padding-left: .4rem !important;border:0px;font-weight:bold">รวมเงินได้</td>
                                        <td style="padding-right: .4rem !important;border:0px;text-align:right"><?php echo number_format($slip->total_income) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: .4rem !important;border:0px;font-weight:bold">รวมเงินหัก</td>
                                        <td style="padding-right: .4rem !important;border:0px;text-align:right"><?php echo number_format($slip->total_deduction) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: .4rem !important;border:0px;font-weight:bold">เงินได้สุทธิ (Net Income)</td>
                                        <td style="padding-right: .4rem !important;border:0px;text-align:right"><?php echo number_format($slip->total_amount) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: .4rem !important;border:0px">ลงชื่อผู้รับเงิน / Sign</td>
                                        <td style="padding-right: .4rem !important;border:0px">_____________________</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: .4rem !important;border:0px">วันที่ / Date</td>
                                        <td style="padding-right: .4rem !important;border:0px">_____________________</td>
                                    </tr>
                                </tbody>
                            </table>
                    </td>
                </tr>
                 
        </table> 

    </div>

</body>

</html>