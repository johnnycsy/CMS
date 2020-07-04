<?php


namespace App\Http\Controllers\Cms\Controllers;


use App\Http\Controllers\Cms\Service\Impl\ProductServiceImpl;
use App\Http\Controllers\Common\ConfigInc;
use App\Http\Controllers\Controller;
use mysql_xdevapi\Exception;


class ProductControllers extends Controller
{

    private $ci;
    private $impl;

    public function __construct()
    {
        $this->ci = new ConfigInc();
        $this->impl = new ProductServiceImpl();
    }

    /**
     * @OA\POST(
     *      path="/api/getProduct",
     *      operationId="Module",
     *      tags={"Cms 商品"},
     *      summary="查询商品列表",
     *      description="查询商品列表",
     *      @OA\Parameter( name="page",description="查询页",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="size",description="查询每页显示数",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="search",description="搜索名称对象",required=false,in="path",@OA\Schema(type="string")),
     *      @OA\Parameter( name="sid",description="查询所属分类",required=false,in="path",@OA\Schema(type="integer")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function getProduct()
    {
        try {
            $page = $this->ci->getParam("page");
            $size = $this->ci->getParam("size");
            $search = $this->ci->getParam("search");
            $sid = $this->ci->getParam("sid");

            if ($page == "" || $size == "") {
                $page = 1;
                $size = 20;
            }

            $page = (int)$page;
            $size = (int)$size;

            $rsList = $this->impl->getProductAllList($page, $size, $search, $sid);

            return $this->ci->rsJson(0, $rsList);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *      path="/api/newProduct",
     *      operationId="Module",
     *      tags={"Cms 商品"},
     *      summary="创建商品信息",
     *      description="创建商品信息",
     *      @OA\Parameter( name="sid",description="所属ID",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="proName",description="商品名称",required=true,in="path",@OA\Schema(type="string")),
     *      @OA\Parameter( name="proPrice",description="商品价格",required=true,in="path",@OA\Schema(type="float")),
     *      @OA\Parameter( name="proUnit",description="商品单位",required=true,in="path",@OA\Schema(type="string")),
     *      @OA\Parameter( name="proTitle",description="商品简介",required=true,in="path",@OA\Schema(type="string")),
     *      @OA\Parameter( name="proVal",description="商品详情",required=true,in="path",@OA\Schema(type="string")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function newProduct()
    {
        try {
            $sid = $this->ci->getParam("sid");
            $proName = $this->ci->getParam("proName");
            $proPrice = $this->ci->getParam("proPrice");
            $proUnit = $this->ci->getParam("proUnit");
            $proTitle = $this->ci->getParam("proTitle");
            $proVal = $this->ci->getParam("proVal");

            if ($sid == "" || $proName == "" || $proPrice == "" || $proUnit == "") {
                return $this->ci->rsJson(404, "商品主要信息缺失，商品创建失败");
            }

            $rsList = $this->impl->getProductNameSidList($sid, $proName);
            if (count($rsList) > 0) {
                return $this->ci->rsJson(505, "当前商品信息已存在，创建终止");
            }

            $proId = $this->impl->newProductInteger($sid, $proName, $proPrice, $proUnit, $proTitle, $proVal);

            return $this->ci->rsJson(0, $proId);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *      path="/api/setProduct",
     *      operationId="Module",
     *      tags={"Cms 商品"},
     *      summary="更新商品信息",
     *      description="更新商品信息",
     *      @OA\Parameter( name="id",description="目标ID",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="sid",description="所属ID",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="proName",description="商品名称",required=true,in="path",@OA\Schema(type="string")),
     *      @OA\Parameter( name="proPrice",description="商品价格",required=true,in="path",@OA\Schema(type="float")),
     *      @OA\Parameter( name="proUnit",description="商品单位",required=true,in="path",@OA\Schema(type="string")),
     *      @OA\Parameter( name="proTitle",description="商品简介",required=true,in="path",@OA\Schema(type="string")),
     *      @OA\Parameter( name="proVal",description="商品详情",required=true,in="path",@OA\Schema(type="string")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function setProduct()
    {
        try {
            $id = $this->ci->getParam("id");
            $sid = $this->ci->getParam("sid");
            $proName = $this->ci->getParam("proName");
            $proPrice = $this->ci->getParam("proPrice");
            $proUnit = $this->ci->getParam("proUnit");
            $proTitle = $this->ci->getParam("proTitle");
            $proVal = $this->ci->getParam("proVal");

            if ($sid == "" || $proName == "" || $proPrice == "" || $proUnit == "") {
                return $this->ci->rsJson(404, "商品主要信息缺失，商品创建失败");
            }

            $rsList = $this->impl->getProductNameSidNotIdList($id, $sid, $proName);
            if (count($rsList) > 0) {
                return $this->ci->rsJson(505, "商品修改失败，此商品名已存在，更新终止");
            }

            $resInteger = $this->impl->setProductInteger($id, $sid, $proName, $proPrice, $proUnit, $proTitle, $proVal);

            return $this->ci->rsJson(0, $resInteger);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *      path="/api/delProduct",
     *      operationId="Module",
     *      tags={"Cms 商品"},
     *      summary="删除商品信息",
     *      description="删除商品信息",
     *      @OA\Parameter( name="id",description="目标ID",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function delProduct()
    {
        try {
            $id = $this->ci->getParam("id");

            if ($id==""){
                return  $this->ci->rsJson(404,"检测商品目标信息为空，暂时终止执行");
            }

            return $this->ci->rsJson(0, $this->impl->delProductinteger($id));
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

}
