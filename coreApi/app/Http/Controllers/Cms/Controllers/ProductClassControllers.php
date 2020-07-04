<?php
/**
 * Created by PhpStorm PHP Version 7.3.9
 * User：johnn
 * Date：2020/5/23
 * Time：5:00 下午
 * WebSite：www.ooago.com
 * Developer：Johnny
 * Project Name：johnnyCms
 */


namespace App\Http\Controllers\Cms\Controllers;


use App\Http\Controllers\Cms\Service\Impl\ProductClassServiceImpl;
use App\Http\Controllers\Common\ConfigInc;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class ProductClassControllers extends Controller
{

    /**
     * @var ConfigInc
     */
    private $ci;

    /**
     * @var ProductClassServiceImpl
     */
    private $impl;

    /**
     * ProductClassControllers constructor.
     */
    public function __construct()
    {
        $this->ci = new ConfigInc();
        $this->impl = new ProductClassServiceImpl();
    }

    /**
     * @OA\POST(
     *      path="/api/getProductClass",
     *      operationId="Module",
     *      tags={"Cms 商品分类"},
     *      summary="getProductClass 查询所有商品分类",
     *      description="getProductClass 查询所有商品分类",
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function getProductClass()
    {
        try {
            $resList = $this->impl->getProductClassList();
            return $this->ci->rsJson(0, $resList);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *      path="/api/newProductClass",
     *      operationId="Module",
     *      tags={"Cms 商品分类"},
     *      summary="创建商品分类",
     *      description="创建商品分类",
     *      @OA\Parameter( name="sid",description="所属ID",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="name",description="分类名称",required=true,in="path",@OA\Schema(type="string")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function newProductClass()
    {
        try {
            $sid = $this->ci->getParam("sid");
            $name = $this->ci->getParam("name");

            if ($sid == "" || $name == "") {
                return $this->ci->rsJson(404, "操作内容唯空，保存失败");
            }

            $rsList = $this->impl->getProductClassNameList($name, $sid);
            if (count($rsList) > 0) {
                return $this->ci->rsJson(505, "分类名称已存在，无法创建");
            }

            return $this->ci->rsJson(0, $this->impl->newProductClass($sid, $name));
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *      path="/api/setProductClass",
     *      operationId="Module",
     *      tags={"Cms 商品分类"},
     *      summary="更新分类名称",
     *      description="更新分类名称",
     *      @OA\Parameter( name="sid",description="所属ID",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="name",description="分类名称",required=true,in="path",@OA\Schema(type="string")),
     *      @OA\Parameter( name="id",description="目标ID",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function setProductClass()
    {
        try {
            $id = $this->ci->getParam("id");
            $sid = $this->ci->getParam("sid");
            $name = $this->ci->getParam("name");

            if ($id == "" || $sid == "" || $name == "") {
                return $this->ci->rsJson(404, "操作对象丢失或空值，操作终止");
            }

            $rsList = $this->impl->getProductClassNameIdList($id, $sid, $name);
            if (count($rsList) > 0) {
                return $this->ci->rsJson(505, "分类名称已存在，更新失败");
            }

            return $this->ci->rsJson(0, $this->impl->setProductClass($id, $sid, $name));
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *      path="/api/delProductClass",
     *      operationId="Module",
     *      tags={"Cms 商品分类"},
     *      summary="删除分类",
     *      description="删除分类",
     *      @OA\Parameter( name="id",description="目标ID",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function delProductClass()
    {
        try {
            $id = $this->ci->getParam("id");

            if ($id == "") {
                return $this->ci->rsJson(404, "操作对象丢失，操作终止");
            }

            return $this->ci->rsJson(0, $this->impl->delProductClass($id));
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

}
