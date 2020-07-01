<?php
/**
 * Created by PhpStorm PHP Version 7.3.9
 * User：johnn
 * Date：2020/5/23
 * Time：1:30 上午
 * WebSite：www.ooago.com
 * Developer：Johnny
 * Project Name：johnnyCms
 */


namespace App\Http\Controllers\Cms\Service\Impl;


use Illuminate\Support\Facades\DB;

class ArticeClassServiceImpl
{

    /**
     * ArticeClassServiceImpl constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getArticeClassList()
    {
        return DB::table("artice_class")->get();
    }

    /**
     * 创建分类
     * @param $sid
     * @param $name
     * @return bool
     */
    public function newArticeClassList($sid, $name)
    {
        $time = date("Y-m-d H:i:s");
        $sql = [
            "sid" => $sid,
            "name" => $name,
            "create_time" => $time,
            "update_time" => $time
        ];
        return DB::table("artice_class")->insert($sql);
    }

    /**
     * 修改分类名称
     * @param $id
     * @param $sid
     * @param $name
     * @return int
     */
    public function setArticeClassList($id, $sid, $name)
    {
        $time = date("Y-m-d H:i:s");
        $sql = [
            "sid" => $sid,
            "name" => $name,
            "update_time" => $time
        ];
        return DB::table("artice_class")->where("id", $id)->update($sql);
    }

    /**
     * 删除文章分类
     * @param $id
     * @return bool|int
     */
    public function delArticeClassId($id)
    {
        $list = DB::table("artice_class")->where("sid", $id)->get();

        if (count($list) > 0) {
            return "当前分类下有文章存在，无法删除";
        }

        return DB::table("artice_class")->where("id", $id)->delete($id);
    }

}
