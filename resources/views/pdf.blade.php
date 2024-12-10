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

    </style>
</head>

<body>
    <div>
        <table style="width: 100%;">
            <thead>
                <tr class="table-info">
                    <th style="text-align: center;padding: .0rem !important;" colspan="4">ข้อมูลผู้พนักงาน</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: .0rem !important;">รหัส</td>
                    <td style="color: blue;padding: .0rem !important;">{{ $employee->code }}</td>
                </tr>
                <tr>
                    <td style="padding: .0rem !important;">ชื่อ-นามสกุล</td>
                    <td style="color: blue;padding: .0rem !important;">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td style="color: blue;padding: .0rem !important;">ชื่อเล่น :</td>
                    <td style="color: blue;padding: .0rem !important;">{{ $employee->nick_name }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr class="table-success">
                    <th style="width: 40px;">เข้า</th>
                    <th>รูปหน้าบัตร</th>
                    <th>รูปถ่ายบัตรประชาชน</th>
                    <th>รูปคนผู้มาติดต่อ</th>
                    <th>รูปรถผู้มาติดต่อ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>
                        <img src="{{ $employee->url1 }}" width="124px"/>
                    </td>
                    <td>
                        <img src="{{ $employee->url2 }}" width="124px"/>
                    </td>
                    <td>
                        <img src="{{ $employee->url3 }}" width="124px"/>
                    </td>
                    <td>
                        <img src="{{ $employee->url4 }}" width="124px"/>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <thead>
                <tr class="table-danger">
                    <th style="width: 40px;">ออก</th>
                    <th>รูปถ่ายคนผู้มาติดต่อ</th>
                    <th>รูปถ่ายรถผู้มาติดต่อ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>
                    <img src="{{ $employee->url7 }}" width="124px"/>
                    </td>
                    <td>
                    <img src="{{ $employee->url8 }}" width="124px"/>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

</body>

</html>