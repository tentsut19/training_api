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
            <tr>
                <td colspan="3" style="vertical-align:top;">
                    <table cellpadding = "0" cellspacing = "0" style="width:100%;table-layout: auto;height: 0;">
                    <thead>
                            <tr style="border: 1px solid #000000">
                                @foreach ($workList as $workItem)
                                <td
                                style="padding-left:10px;border: 1px solid #000000;
                                vertical-align:top;background-color:#dbdbdb;font-weight:bold;text-align:center">
                                    {{$workItem['date']}}
                                </td>
                                @endforeach    
                            </tr>
                    </thead>
                        <tbody>
                            <tr style="border: 1px solid #000000">
                                @foreach ($workList as $workItem)
                                <td style="padding-left:10px;border: 1px solid #000000;vertical-align:center;text-align:center">
                                {{$workItem['desc']}}
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="title">ชื่อพนักงาน (Name) : </span>
                    <span>&nbsp;{{$employeeName}}</span>
                </td>
                <td>
                    <span class="title">แผนก(Dept.) : </span>
                    <span>&nbsp;พนักงานปฏิบัติงาน</span>
                </td>
                <td>
                    <span class="title">ประจำงวด(Peroid) : </span>
                    <span> วันที่ {{$peroid}}</span>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <span class="title">หน่วยงาน : </span>
                    <span>
                    {{$customerName}}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    <br />
    <table id="table-slip"
    cellpadding = "0" cellspacing = "0" style="width:100%;border: 1px solid #dbdbdb">   
        <tbody>
            <tr>
            <td style="vertical-align:top;">
                <table cellpadding = "0" cellspacing = "0" style="width:100%;border-bottom: 1px solid #dbdbdb;">
                    <thead>
                    <tr>
                        <th style="border-right: 1px solid #dbdbdb;border-bottom: 1px solid #dbdbdb;width:80%">
                            <span class="title">&nbsp;รายได้</span>
                        </th>
                        <th style="border-right: 1px solid #dbdbdb;border-bottom: 1px solid #dbdbdb">
                            <span class="title">&nbsp;จำนวนเงิน</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($incomeList as $incomeItem)
                        <tr>
                            <td style="padding-left:10px;border-right: 1px solid #dbdbdb;vertical-align:top;">
                            &nbsp;{{$incomeItem['name']}}
                            <?php 
                                if($incomeItem['code'] == "001" || $incomeItem['code'] == "002"
                                || $incomeItem['code'] == "0001"|| $incomeItem['code'] == "0002"){
                                    echo " (".$incomeItem['quantity']." วัน)";
                                }
                            ?>
                            </td>
                            <td style="text-align:center;">
                            <?php echo number_format($incomeItem['total'],2); ?>
                            </td>
                        </tr>
                    @endforeach 
                    </tbody>
                </table>
            </td>
            <td style="vertical-align:top;border-left: 1px solid #dbdbdb;">
                <table cellpadding = "0" cellspacing = "0" style="width:100%;border-bottom: 1px solid #dbdbdb;">
                    <thead>
                    <tr>
                        <th style="border-right: 1px solid #dbdbdb;width:80%;border-bottom: 1px solid #dbdbdb">
                            <span class="title">&nbsp;รายการหัก</span>
                        </th>
                        <th style="border-right: 1px solid #dbdbdb;border-bottom: 1px solid #dbdbdb">
                            <span class="title">&nbsp;จำนวนเงิน</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($deductList as $deductItem)
                        <tr>
                            <td style="padding-left:10px;border-right: 1px solid #dbdbdb;vertical-align:top;">
                            <?php if($deductItem['code']=="002"){ ?>
                                &nbsp;<b>{{$deductItem['name']}}</b>
                                <?php if($extend002!=""){ ?>&nbsp;{{$extend002}} <?php } ?>
                            <?php }else if($deductItem['code']=="003"){ ?>
                                &nbsp;<b>{{$deductItem['name']}}</b>
                                <?php if($extend003!=""){ ?>&nbsp;{{$extend003}} <?php } ?>
                            <?php }else if($deductItem['code']=="004"){ ?>
                                &nbsp;<b>{{$deductItem['name']}}</b>
                            <?php if($extend004!=""){ ?>&nbsp;{{$extend004}} <?php } ?>
                            <?php }else{ ?>
                                &nbsp;{{$deductItem['name']}}
                            <?php } ?>
                            </td>
                            <td style="text-align:center;">
                            <?php echo number_format($deductItem['total'],2); ?>
                            </td>
                        </tr>
                    @endforeach 
                    </tbody>
                </table>
            </td>
            <td style="border-left: 1px solid #dbdbdb;">
                <table cellpadding = "0" cellspacing = "0" style="width:100%">
                    <thead>
                    <tr>
                        <th class="bg-title">
                            <span class="title">เงินได้สุทธิ</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td style="text-align:center">
                                    <span>
                                        <?php echo number_format($total,2); ?>
                                    </span>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding = "0" cellspacing = "0" style="width:100%">
                <tbody>
                <tr>
                            <td class="bg-title" style="width:80%;border: 1px solid #dbdbdb;">
                            &nbsp;<span class="title">รวมรายได้</span>
                            </td>
                            <td style="text-align:center;border: 1px solid #dbdbdb;">
                            <?php echo number_format($totalIncome,2); ?>
                            </td>
                        </tr>
                </tbody>
                </table>
            </td>
            <td>
            <table cellpadding = "0" cellspacing = "0" style="width:100%">
                <tbody>
                <tr>
                            <td class="bg-title" style="width:80%;border: 1px solid #dbdbdb;">
                            &nbsp;<span class="title">รวมรายการหัก</span>
                            </td>
                            <td style="text-align:center;border: 1px solid #dbdbdb;">
                            <?php echo number_format($totalDeduct,2); ?>
                            </td>
                        </tr>
                </tbody>
                </table>
            </td>
            <td></td>
        </tr>
        </tbody>
    </table>
    
    <table cellpadding = "0" cellspacing = "0" style="width:100%">
        <tbody>
            <tr>
                <td style="width:60%">
                    <div>
                        <span style="font-weight:bold">วันหยุดประจำงวด</span>
                    <div>
                    <table cellpadding = "0" cellspacing = "0" style="width:100%">
                        <tr>
                            <td style="border: 1px solid #ffffff;width:30px">
                                 
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="text-align:right;width:40%">
                    <span class="title">ลงชื่อ</span>
                    <span>......................................................</span>
                    <span class="title">ผู้รับสลิป</span>
                    <br />
                    <img src="https://comvisitor-uat-bucket.s3.ap-southeast-1.amazonaws.com/tis/images/signature.png" 
                    style="width:20%;padding: right 90px;margin-bottom:-50px"/>
                    <br />
                    <span class="title">ลงชื่อ</span>
                    <span>......................................................</span>
                    <span class="title">การเงิน</span>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>