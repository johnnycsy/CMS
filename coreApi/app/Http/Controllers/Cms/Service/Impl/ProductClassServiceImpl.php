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
        return DB::table("product_class")->get();
    }

}
