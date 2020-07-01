<?php
/**
 * Created by PhpStorm PHP Version 7.3.9
 * User：johnn
 * Date：2020/5/23
 * Time：1:29 上午
 * WebSite：www.ooago.com
 * Developer：Johnny
 * Project Name：johnnyCms
 */


namespace App\Http\Controllers\Cms\Controllers;


use App\Http\Controllers\Cms\Service\Impl\ArticeClassServiceImpl;
use App\Http\Controllers\Common\ConfigInc;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class ArticeClassControllers extends Controller
{

    /**
     * @var ConfigInc
     */
    private $ci;
    /**
     * @var ArticeClassServiceImpl
     */
    private $impl;

    /**
     * ArticeClassControllers constructor.
     */
    public function __construct()
    {
        $this->ci = new ConfigInc();
        $this->impl = new ArticeClassServiceImpl();
    }

    /**
     * @OA\GET(
     *      path="/api/getArticeClass",
     *      operationId="Module",
     *      tags={"Cms 文章/新闻"},
     *      summary="getArticeClass 查询文章所有分类",
     *      description="getArticeClass 查询文章所有分类",
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function getArticeClass()
    {
        try {
            return $this->impl->getArticeClassList();
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *      path="/api/newArticeClass",
     *      operationId="Module",
     *      tags={"Cms 文章/新闻"},
     *      summary="newArticeClass 创建文章分类",
     *      description="newArticeClass 创建文章分类",
     *      @OA\Parameter( name="sid",description="所属id",required=true,in="path",@OA\Schema(type="Interger")),
     *      @OA\Parameter( name="name",description="分类名称",required=true,in="path",@OA\Schema(type="String")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function newArticeClass()
    {
        try {
            $sid = $this->ci->getParam("sid");
            $name = $this->ci->getParam("name");

            $sid = isEmpty($sid) ? 0 : (int)$sid;

            if (isEmpty($name)) {
                return $this->ci->rsJson(404, "分类名称不能为空");
            }

            $res = $this->impl->newArticeClassList($sid, $name);

            return $this->ci->rsJson(0, $res);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *      path="/api/setArticeClass",
     *      operationId="Module",
     *      tags={"Cms 文章/新闻"},
     *      summary="setArticeClass 修改文章分类",
     *      description="setArticeClass 修改文章分类",
     *      @OA\Parameter( name="id",description="文章id",required=true,in="path",@OA\Schema(type="Interger")),
     *      @OA\Parameter( name="sid",description="所属id",required=true,in="path",@OA\Schema(type="Interger")),
     *      @OA\Parameter( name="name",description="分类名称",required=true,in="path",@OA\Schema(type="String")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function setArticeClass()
    {
        try {
            $id = $this->ci->getParam("id");
            $sid = $this->ci->getParam("sid");
            $name = $this->ci->getParam("name");

            $sid = isEmpty($sid) ? 0 : (int)$sid;

            if (isEmpty($name) || isEmpty($id)) {
                return $this->ci->rsJson(404, "分类名称与分类id不能为空");
            }

            $res = $this->impl->setArticeClassList($id, $sid, $name);

            return $this->ci->rsJson(0, $res);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *      path="/api/delArticeClass",
     *      operationId="Module",
     *      tags={"Cms 文章/新闻"},
     *      summary="delArticeClass 删除文章分类",
     *      description="delArticeClass 删除文章分类",
     *      @OA\Parameter( name="id",description="文章id",required=true,in="path",@OA\Schema(type="Interger")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function delArticeClass()
    {
        try {
            $id = $this->ci->getParam("id");

            if (isEmpty($id)) {
                return $this->ci->rsJson(404, "删除目标不能为空");
            }

            $res = $this->impl->delArticeClassId($id);

            return $this->ci->rsJson(0, $res);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

}
