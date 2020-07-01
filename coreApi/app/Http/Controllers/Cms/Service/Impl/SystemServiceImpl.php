<?php
/**
 * Created by PhpStorm PHP Version 7.3.9
 * User：johnn
 * Date：2020/5/23
 * Time：3:49 下午
 * WebSite：www.ooago.com
 * Developer：Johnny
 * Project Name：johnnyCms
 */


namespace App\Http\Controllers\Cms\Service\Impl;


use App\Http\Controllers\Common\ConfigInc;
use Illuminate\Support\Facades\DB;

class SystemServiceImpl
{
    /**
     * @var ConfigInc
     */
    private $ci;

    /**
     * SystemServiceImpl constructor.
     */
    public function __construct()
    {
        $this->ci = new ConfigInc();
    }

    /**
     * 写入配置
     * @param $web_name
     * @param $web_host
     * @param $web_seo
     * @param $web_title
     * @param $web_describe
     * @param $web_qq
     * @param $web_wechat
     * @param $web_email
     * @param $web_contact
     * @return bool
     */
    public function newSystem($web_name, $web_host, $web_seo, $web_title, $web_describe, $web_qq, $web_wechat, $web_email, $web_contact)
    {
        $time = date("Y-m-d H:i:s");
        $newArr = [
            "web_name" => $web_name,
            "web_host" => $web_host,
            "web_seo" => $web_seo,
            "web_title" => $web_title,
            "web_describe" => $web_describe,
            "web_qq" => $web_qq,
            "web_wechat" => $web_wechat,
            "web_email" => $web_email,
            "web_contact" => $web_contact,
            "create_time" => $time,
            "update_time" => $time
        ];
        return DB::table("csm_system")->insert($newArr);
    }

    /**
     * 更新配置
     * @param $web_name
     * @param $web_host
     * @param $web_seo
     * @param $web_title
     * @param $web_describe
     * @param $web_qq
     * @param $web_wechat
     * @param $web_email
     * @return int
     */
    public function setSystem($web_name, $web_host, $web_seo, $web_title, $web_describe, $web_qq, $web_wechat, $web_email, $web_contact)
    {
        $time = date("Y-m-d H:i:s");
        $newArr = [
            "web_name" => $web_name,
            "web_host" => $web_host,
            "web_seo" => $web_seo,
            "web_title" => $web_title,
            "web_describe" => $web_describe,
            "web_qq" => $web_qq,
            "web_wechat" => $web_wechat,
            "web_email" => $web_email,
            "web_contact" => $web_contact,
            "update_time" => $time
        ];
        return DB::table("csm_system")->update($newArr);
    }

    /**
     * 查询数据数量
     * @return \Illuminate\Support\Collection
     */
    public function getSystemList()
    {
        return DB::table("csm_system")->get();
    }

}
