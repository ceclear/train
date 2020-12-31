<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache">
    <title>一年级</title>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            height: 100vh;
        }

        table.gridtable {
            font-family: verdana, arial, sans-serif;
            font-size: 28px;
            color: #333333;
            border-width: 1px;
            border-color: #666666;
            border-collapse: collapse;
        }

        table.gridtable th {
            border-width: 1px;
            padding: 3px 3px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;
        }

        table.gridtable td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
            text-align: center;
        }

        .answer-input {
            padding: 8px;
        }
    </style>
</head>
<body>

<div style="margin:400px auto;width: 800px;text-align: center">
    <p style="font-weight: bold;font-size: 28px">{{$data['msg']}}</p>
    @if($data['code']==1)
        <a href="javascript:history.go(-1)" style="color:red">返回</a>
    @endif
    @if($data['code']==0&&$data['sub_id'])
        <a href="{{url('level1/show',['sub_id'=>$data['sub_id']])}}" style="color:red">查看成绩</a>
    @endif

</div>


</body>
</html>
