<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายการอุปกรณ์</title>
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
        .bg-header-table{
            background-color:#dbdbdb !important;
        }
    </style>
</head>

<body> 
    <table cellpadding = "0" cellspacing = "0" style="width:100%">
        <tbody>
            <tr>
                <td colspan="3" style="text-align:center">
                    <h2>รายการอุปกรณ์</h2>
                </td>
            </tr>  
        </tbody>
    </table>
    <br /> 
    <table cellpadding = "0" cellspacing = "0" style="width:100%;table-layout: auto;height: 0;">
                    <thead class="bg-header-table">
                            <tr style="border: 1px solid #000000">
                                <td style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;font-weight:bold;text-align:center;width:15%">
                                    รหัสอุปกรณ์ (IMEI)
                                </td> 
                                <td style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;font-weight:bold;text-align:center;width:15%">
                                    ชื่ออุปกรณ์
                                </td> 
                                <td style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;font-weight:bold;text-align:center;width:20%">
                                    หน่วยงาน
                                </td> 
                                <td style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;font-weight:bold;text-align:center;width:30%">
                                    รายละเอียดเพิ่มเติม
                                </td> 
                                <td style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;font-weight:bold;text-align:center;width:10%">
                                    สถานะ
                                </td> 
                                <td style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;font-weight:bold;text-align:center;width:10%">
                                    วันที่สร้าง
                                </td> 
                            </tr>
                    </thead>
                        <tbody>
                        <?php if(count($data) == 0){ ?>  
                            <tr style="border: 1px solid #000000">
                                <td colspan="6" style="text-align:center">--- ไม่พบข้อมูล ---</td>
                            </tr>
                        <?php }else{ ?>
                            @foreach ($data as $item)
                        <tr style="border: 1px solid #000000">
                                <td style="padding-left:10px;border: 1px solid #000000;vertical-align:center;text-align:center;
                                padding-top:10px;padding-bottom:10px;">
                                 <span style="font-weight:bold">{{$item['imei']}}</span>
                                </td>
                                <td style="padding-left:10px;border: 1px solid #000000;vertical-align:center;text-align:left;
                                padding-top:10px;padding-bottom:10px;">
                                 <span style="padding-left:5px">{{$item['name']}}</span>
                                </td>
                                <td style="padding-left:10px;border: 1px solid #000000;vertical-align:center;text-align:left;
                                padding-top:10px;padding-bottom:10px;">
                                 <span style="padding-left:5px">{{$item['agency_name']}}</span>
                                </td>
                                <td style="padding-left:10px;border: 1px solid #000000;vertical-align:center;text-align:left;
                                padding-top:10px;padding-bottom:10px;">
                                 <span style="padding-left:3px">{{$item['description']}}</span>
                                </td>
                                <td style="padding-left:10px;border: 1px solid #000000;vertical-align:center;text-align:center;
                                padding-top:10px;padding-bottom:10px;">
                                    <?php if($item['is_active'] == "1" || $item['is_active'] == true){ ?>
                                        <span style="color:green;font-weight:bold">เปิดใช้งาน</span>
                                    <?php } ?>
                                    <?php if($item['is_active'] == "0" || $item['is_active'] == false){ ?>
                                        <span style="color:red;font-weight:bold">ปิดใช้งาน</span>
                                    <?php } ?>
                                </td>
                                <td style="padding-left:10px;border: 1px solid #000000;vertical-align:center;text-align:center;
                                padding-top:10px;padding-bottom:10px;">
                                 <span>{{$item['created_at']}}</span>
                                </td>
                            </tr> 
                        @endforeach
                        <?php } ?>
                        </tbody>
                    </table>
</body>
</html>