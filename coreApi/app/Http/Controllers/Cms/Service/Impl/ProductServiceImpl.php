<?php


namespace App\Http\Controllers\Cms\Service\Impl;


use App\Http\Controllers\Common\ConfigInc;
use Illuminate\Support\Facades\DB;

class ProductServiceImpl
{
    private $ci;

    private $table = "product_main";

    public function __construct()
    {
        $this->ci = new ConfigInc();
    }

    public function getProductAllList($page, $size, $search, $sid)
    {
        $pages = $size * ($page - 1) + 1;
        $sizes = $page * $size;
        $sql = "select * from {$this->table} where pro_name like '%{$search}%' or sid='{$sid}' limit {$pages},{$sizes}";

        return DB::table($sql);
    }

    public function newProductInteger($sid, $proName, $proPrice, $proUnit, $proTitle, $proVal)
    {
        $sqlArr = [
            'sid' => $sid,
            'pro_name' => $proName,
            'pro_price' => $proPrice,
            'pro_unit' => $proUnit,
            'pro_title' => $proTitle,
            'pro_val' => $proVal,
            'create_time' => date("Y-m-d H:i:s"),
            'update_time' => date("Y-m-d H:i:s"),
        ];

        return DB::table($this->table)->insertGetId($sqlArr);
    }

    public function setProductInteger($id, $sid, $proName, $proPrice, $proUnit, $proTitle, $proVal)
    {
        $sqlArr = [
            'sid' => $sid,
            'pro_name' => $proName,
            'pro_price' => $proPrice,
            'pro_unit' => $proUnit,
            'pro_title' => $proTitle,
            'pro_val' => $proVal,
            'create_time' => date("Y-m-d H:i:s"),
            'update_time' => date("Y-m-d H:i:s"),
        ];

        return DB::table($this->table)->where("id", $id)->update($sqlArr);
    }

    public function delProductinteger($id)
    {
        return DB::table($this->table)->delete($id);
    }


    public function getProductNameSidList($sid, $proName)
    {
        return DB::table($this->table)->where("sid", $sid)->where("pro_name", $proName)->get();
    }

    public function getProductNameSidNotIdList($id, $sid, $proName)
    {
        return DB::table($this->table)->where("sid", $sid)->where("pro_name", $proName)->where("id", "<>", $id)->get();
    }

}
