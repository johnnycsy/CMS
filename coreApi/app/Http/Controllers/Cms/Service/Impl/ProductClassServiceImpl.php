<?php
/**
 * Created by PhpStorm PHP Version 7.3.9
 * User：johnn
 * Date：2020/5/23
 * Time：5:09 下午
 * WebSite：www.ooago.com
 * Developer：Johnny
 * Project Name：johnnyCms
 */


namespace App\Http\Controllers\Cms\Service\Impl;


use App\Http\Controllers\Common\ConfigInc;
use Illuminate\Support\Facades\DB;

class ProductClassServiceImpl
{
    /**
     * @var ConfigInc
     */
    private $ci;

    private $table = "product_class";

    /**
     * ProductClassServiceImpl constructor.
     */
    public function __construct()
    {
        $this->ci = new ConfigInc();
    }

    /**
     * 获取所有分类
     * @return \Illuminate\Support\Collection
     */
    public function getProductClassList()
    {
        return DB::table($this->table)->get();
    }

    public function newProductClass($sid, $name)
    {
        $arr = [
            'sid' => $sid,
            'name' => $name,
            'create_time' => date("Y-m-d H:i:s"),
            'update_time' => date("Y-m-d H:i:s"),
        ];
        return DB::table("product_class")->insertGetId($arr);
    }

    public function setProductClass($id, $sid, $name)
    {
        $arr = [
            'sid' => $sid,
            'name' => $name,
            'update_time' => date("Y-m-d H:i:s"),
        ];
        return DB::table($this->table)->where("id", $id)->update($arr);
    }

    public function delProductClass($id)
    {
        return DB::table($this->table)->where("id", $id)->delete();
    }

    public function getProductClassNameList($name, $sid)
    {
        return DB::table($this->table)->where("name", $name)->where("sid", $sid);
    }

    public function getProductClassNameIdList($id, $sid, $name)
    {
        return DB::table($this->table)->where("name", $name)->where("sid", $sid)->where("id", "!=", $id);
    }

}
