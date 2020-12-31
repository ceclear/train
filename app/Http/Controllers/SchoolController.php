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

    public function index()
    {
        $max = request('max', 20);
        $num = 0;
        $every = 10;
        $count = request('count', 20);
        $arr = [];
        $cssDiv = "height:60px;line-height:60px;font-weight:bold;width: 260px;border-right:1px solid #ccc;float: left;padding-left: 10px;font-size:36px";
        do {
            $first = rand(1, $max);
            $second = rand(1, $max);
            $third = rand($second, $max);
            $four = rand(1, $max);
            $five = rand(1, $max);
            $six = rand($five, $max);
            $rel1 = $first + $second - $third;
            $rel2 = $five - $four + $six;
            $str1 = $first . "+" . $second . "-" . $third . '=';
            $str2 = $five . "-" . $four . "+" . $six . '=';
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
            $list[$i][] = $arr[$i * 2];
            $list[$i][] = $arr[$i * 2 + 1];
        }
        return view('Level1.index', compact("list"));
    }

    public function show()
    {
        $num = 10;
        $list = SubtractDetail::all()->toArray();
        for ($i = 0; $i < $num; $i++) {
            $arr[$i][] = $list[$i * 2];
            $arr[$i][] = $list[$i * 2 + 1];
        }
        return view('Level1.index', compact("arr"));
    }

    public function submit()
    {
        $param = request()->post();
        unset($param['_token']);
        $model = new SubtractDetail();
        DB::beginTransaction();
        $flag = true;
        foreach ($param as $key => $item) {
            if (empty($item)) {
                $flag = false;
                break;
            }
            $arr = explode('_', $key);
            $id = $arr[1];
            $model->where('id', $id)->update(['enter_val' => $item]);
        }
        $data['msg'] = "-_- 好棒,你做完了今天的作业";
        $data['code'] = 0;
        if (!$flag) {
            $data['msg'] = "你有作业没有做完哦,点击下方继续做完";
            $data['code'] = 1;
            DB::rollBack();
            return redirect('level1/success')->with($data);
        }
        DB::commit();
        return redirect('level1/success')->with($data);
    }

    public function success()
    {
        $data = ['msg' => session('msg'), 'code' => session('code')];
        return view('Level1.success', compact("data"));
    }

    public function generateCode()
    {


    }
}
