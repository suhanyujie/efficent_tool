<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 2020-03-18
 * Time: 20:29
 */

namespace App\Http\Controllers;


class BaseController extends Controller
{

    /**
     * @desc 成功时返回数据
     */
    public function success($data = [])
    {
        return [
            'err_no'  => 0,
            'err_msg' => 'success',
            'results' => $data,
        ];
    }
}
