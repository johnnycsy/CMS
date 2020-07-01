<?php
/**
 * Created by PhpStorm PHP Version 7.3.9
 * User：johnn
 * Date：2020/5/18
 * Time：11:51 下午
 * WebSite：www.ooago.com
 * Developer：Johnny
 * Project Name：johnnyCms
 */


namespace App\Http\Controllers\Common;


class ConfigInc
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Shanghai");
    }

    /**
     * 全剧输出格式
     * @param $code
     * @param $val
     * @param string $msg
     * @return false|string
     */
    public function rsJson($code, $val, $msg = "error")
    {
        $arr = [
            "code" => $code,
            "msg" => $code == 0 ? 'success' : $msg,
            "data" => $val
        ];

        return json_encode($arr);
    }

    /**
     * 获取指定参数
     * @param $param
     * @return mixed|string
     */
    public function getParam($param)
    {
        return isset($param) ? $_REQUEST[$param] : "";
    }

}
