<?php
/**
 * Created by PhpStorm PHP Version 7.3.9
 * User：johnn
 * Date：2020/5/22
 * Time：11:43 下午
 * WebSite：www.ooago.com
 * Developer：Johnny
 * Project Name：johnnyCms
 */


namespace App\Http\Controllers\Cms\Service\Impl;


use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ArticeMainServiceImpl
{

    /**
     * 查询所有文章数据
     * @return array
     */
    public function getArticeMainAllList($page, $size)
    {
        $page = $size * ($page - 1) + 1;
        $size = $page * $size;
        $sql = "SELECT tb.*,tc.`name` className FROM `artice_main` tb,artice_class tc WHERE tb.sid=tc.id LIMIT {$page},{$size}";
        return DB::select($sql);
    }

    /**
     * 查询文章详情
     * @param $id
     * @return mixed
     */
    public function getArticeMainIdList($id)
    {
        $sql = "SELECT tb.*,tc.`name` className FROM `artice_main` tb,artice_class tc WHERE tb.sid=tc.id AND tb.id = '{$id}'";
        return DB::selectOne($sql);
    }

    /**
     * 创建文章
     * @param $sid
     * @param $title
     * @param $author
     * @param $subtitle
     * @param $artice_val
     * @param $release_time
     * @return bool
     */
    public function newArticeMainList($sid, $title, $author, $subtitle, $artice_val, $release_time)
    {
        $time = date("Y-m-d H:i:s");
        $insertArr = [
            "sid" => $sid,
            "title" => $title,
            "author" => $author,
            "subtitle" => $subtitle,
            "artice_val" => $artice_val,
            "release_time" => $release_time,
            "create_time" => $time,
            "update_time" => $time,
        ];
        return DB::table("artice_main")->insert($insertArr);
    }

    /**
     * 更新文章
     * @param $sid
     * @param $title
     * @param $author
     * @param $subtitle
     * @param $artice_val
     * @param $release_time
     * @return int
     */
    public function setArticeMainList($id, $sid, $title, $author, $subtitle, $artice_val, $release_time)
    {
        $time = date("Y-m-d H:i:s");
        $insertArr = [
            "sid" => $sid,
            "title" => $title,
            "author" => $author,
            "subtitle" => $subtitle,
            "artice_val" => $artice_val,
            "release_time" => $release_time,
            "update_time" => $time,
        ];
        return DB::table("artice_main")->where("id", $id)->update($insertArr);
    }

    /**
     * 删除文章
     * @param $id
     * @return int|string
     */
    public function delArtice($id)
    {
        try {
            return DB::table("artice_main")->where("id", $id)->delete();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
