<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TISs</title>
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">-->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />-->
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
        .title{
            font-weight: bold;
        } 
        .bg-title
        {
            background-color:#b0e4fb
        }
    </style>
</head>

<body> 
    <table cellpadding = "0" cellspacing = "0" style="width:100%">
        <tbody>
            <tr>
                <td colspan="3" style="text-align:right">
                    <img src="https://comvisitor-uat-bucket.s3.ap-southeast-1.amazonaws.com/images/logo/Logo%E0%B8%90%E0%B8%B2%E0%B8%99%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%A1%E0%B8%B9%E0%B8%A5.jpg" style="width:30%;"/>
                </td>
            </tr> 
            <tr style="padding-top">
                <td>
                    <span class="title">ชื่อพนักงาน (Name) : </span>
                    <span>&nbsp;{{$empName}}</span>
                </td>
                <td>
                    <span class="title">แผนก(Dept.) : </span>
                    <span>&nbsp;{{$deptName}}</span>
                </td>
                <td>
                    <span class="title">ตำแหน่ง(Position.) : </span>
                    <span>&nbsp;{{$positionName}}</span>
                </td>
            </tr> 
            <tr>
                <td colspan="3">
                    <span class="title">ระหว่างวันที่(Peroid) : </span>
                    <span> วันที่ {{$startDate}} <span class="title"> ถึง </span><span>{{$startDate}}</span>
                </td>
            </tr>
        </tbody>
    </table>
    <br /> 
    <table cellpadding = "0" cellspacing = "0" style="width:100%;table-layout: auto;height: 0;">
                    <thead>
                            <tr style="border: 1px solid #000000">
                                <td style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;background-color:#dbdbdb;font-weight:bold;text-align:center;width:13%">
                                    วันที่
                                </td> 
                                <td style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;background-color:#dbdbdb;font-weight:bold;text-align:center;width:10%">
                                    สถานะ
                                </td> 
                                <td style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;background-color:#dbdbdb;font-weight:bold;text-align:center;">
                                    รายละเอียด
                                </td> 
                                <td style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;background-color:#dbdbdb;font-weight:bold;text-align:center;width:15%">
                                    วันที่บันทึกล่าสุด
                                </td> 
                            </tr>
                    </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr style="border: 1px solid #000000">
                                <td style="padding-left:10px;border: 1px solid #000000;vertical-align:center;text-align:center;
                                padding-top:10px;padding-bottom:10px;">
                                 {{$item['work_date']}}
                                </td>
                                <td style="padding-left:10px;border: 1px solid #000000;vertical-align:center;text-align:center;
                                padding-top:10px;padding-bottom:10px;"> 
                                 <?php if($item['status'] == ""){ ?>
                                    <span style="color:red;font-weight:bold">ไม่ลงเวลา</span>
                                 <?php } ?>
                                 <?php if($item['status'] == "SL"){ ?>
                                    <span style="color:orange;font-weight:bold">ลาป่วย</span>
                                 <?php } ?>
                                 <?php if($item['status'] == "VL"){ ?>
                                    <span style="color:orange;font-weight:bold">ลากิจ</span>
                                 <?php } ?>
                                 <?php if($item['status'] == "N"){ ?>
                                    <span style="color:green;font-weight:bold">ปกติ</span>
                                 <?php } ?>
                                </td>
                                <td style="padding-left:10px;border: 1px solid #000000;text-align:left;">
                                 <span>{{$item['details']}}</span>
                                </td>
                                <td style="padding-left:10px;border: 1px solid #000000;vertical-align:center;text-align:center;
                                padding-top:10px;padding-bottom:10px;">
                                 {{$item['updated_at']}}
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
</body>
</html>