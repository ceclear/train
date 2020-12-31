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

    <div style="margin: auto;width: 900px">
        <table class="gridtable">
            <tr>
                <th>题目</th>
                <th>你的答案</th>
                <th>答案</th>
                <th>正确</th>
                <th>题目</th>
                <th>你的答案</th>
                <th>答案</th>
                <th>正确</th>
            </tr>
            @if(!empty($arr))
                @foreach($arr as $item)
                    <tr>
                        @foreach($item as $value)

                            <td>{{$value['key_str']}}</td>
                            <td><label>{{$value['enter_val']}}</label></td>
                            <td><label>{{$value['val']}}</label></td>
                            <td>@if($value['enter_val']==$value['val'])是@else<font color="red">否</font>@endif</td>

                        @endforeach
                    </tr>
                @endforeach
            @endif

        </table>
    </div>


</body>
</html>
