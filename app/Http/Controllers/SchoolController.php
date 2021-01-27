<?php
/*
* mark
* date 2020/12/30
* time 17:19
* author zt
*/

namespace App\Http\Controllers;


use App\Models\SubtractDetail;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{

    //首页
    public function index()
    {
        $max = request('max', 20);
        $num = 0;
        $every = 10;
        $count = request('count', 20);
        $arr = [];
        do {
            $first = rand(1, $max);
            $second = rand(1, $max);
            $third = rand($second, $max);
            $four = rand(1, $max);
            $five = rand(1, $max);
            $six = rand($five, $max);
            $rel1 = $first + $second - $third;
            $rel2 = $five - $four + $six;
            $strVal1 = $first + $second - $third;
            $strVal2 = $five - $four + $six;
            $str1 = $first . "+" . $second . "-" . $third . '=' . $strVal1;
            $str2 = $five . "-" . $four . "+" . $six . '=' . $strVal2;
            if (($rel1 >= 0 && ($first + $second) <= $max) && !in_array($str1, $arr) && count($arr) < $count) {
                $arr[] = $str1;
                $num++;
            }
            if (!in_array($str2, $arr) && ($rel2 >= 0 && ($five - $four) >= 0 && $rel2 <= $max) && count($arr) < $count) {

                $arr[] = $str2;
                $num++;
            }

        } while ($num < $count);
        shuffle($arr);
        for ($i = 0; $i < $every; $i++) {
            $a = explode('=', $arr[$i * 2]);
            $b = explode('=', $arr[$i * 2 + 1]);
            $list[$i][] = ['key_str' => $a[0], 'val' => $a[1]];
            $list[$i][] = ['key_str' => $b[0], 'val' => $b[1]];
        }
//        dd($list);
        return view('Level1.index', compact("list"));
    }

    public function show()
    {
        $subId = request('sub_id');
        $num = 10;
        $list = SubtractDetail::where('sub_id', $subId)->get()->toArray();
        $arr = [];
        if ($list) {
            for ($i = 0; $i < $num; $i++) {
                $arr[$i][] = $list[$i * 2];
                $arr[$i][] = $list[$i * 2 + 1];
            }
        }
        return view('Level1.show', compact("arr"));
    }

    public function submit()
    {
        $param = request()->post();

        unset($param['_token']);
        DB::beginTransaction();
        $flag = true;
        $msg = "-_- 好棒,你做完了今天的作业,点击下方查看成绩";
        $insert = [];
        $maxSub = SubtractDetail::max('sub_id');
        $subId = $maxSub ? $maxSub + 1 : 1;
        $keyArr = [];
        foreach ($param as $key => $item) {
            $kk = explode('_', $key)[1];
            if (in_array($kk, $keyArr)) {
                $insert[] = ['sub_id' => $subId, 'key_str' => $kk, 'val' => $param['hi_' . $kk], 'enter_val' => $param['val_' . $kk], 'created_at' => time()];
            }
            $keyArr[] = $kk;
            if ($item == '') {
                $flag = false;
                $msg = "你有作业没有做完哦,点击下方继续做完";
                break;
            }
        }
        SubtractDetail::insert($insert);
        $data['msg'] = $msg;
        $data['code'] = 0;
        $data['sub_id'] = $subId;
        if (!$flag) {
            $data['msg'] = $msg;
            $data['code'] = 1;
            DB::rollBack();
            return redirect('level1/success')->with($data);
        }
        DB::commit();
        return redirect('level1/success')->with($data);
    }

    public function success()
    {
        $data = ['msg' => session('msg'), 'code' => session('code'), 'sub_id' => session('sub_id')];
        return view('Level1.success', compact("data"));
    }
}
