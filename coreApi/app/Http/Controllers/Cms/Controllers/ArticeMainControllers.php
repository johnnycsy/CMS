<?php
/**
 * Created by PhpStorm PHP Version 7.3.9
 * User：johnn
 * Date：2020/5/22
 * Time：9:41 下午
 * WebSite：www.ooago.com
 * Developer：Johnny
 * Project Name：johnnyCms
 */


namespace App\Http\Controllers\Cms\Controllers;


use App\Http\Controllers\Cms\Service\Impl\ArticeMainServiceImpl;
use App\Http\Controllers\Common\ConfigInc;
use App\Http\Controllers\Controller;
use Mockery\Exception;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Johnny Cms Api",
 *      description="Johnny Cms Api ",
 *      @OA\Contact(
 *          email="johnny_login@163.com"
 *      )
 * )
 */
class ArticeMainControllers extends Controller
{

    /**
     * @var ConfigInc
     */
    private $ci;

    /**
     * @var ArticeMainServiceImpl
     */
    private $impl;

    /**
     * ArticeMainControllers constructor.
     */
    public function __construct()
    {
        $this->ci = new ConfigInc();
        $this->impl = new ArticeMainServiceImpl();
    }

    /**
     * @OA\GET(
     *      path="/api/getAritecList",
     *      operationId="Module",
     *      tags={"Cms 文章/新闻"},
     *      summary="getAritecList 查询文章/新闻列表",
     *      description="getAritecList 查询文章/新闻列表",
     *      @OA\Parameter( name="page",description="查询目标页数",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="size",description="每页显示数量",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function getAritecList()
    {
        try {
            $page = $this->ci->getParam("page");
            $size = $this->ci->getParam("size");

            if (isEmpty($page) || $page <= 0 || isEmpty($size)) {
                $page = 1;
                $size = 20;
            }

            $list = $this->impl->getArticeMainAllList($page, $size);
            return $this->ci->rsJson(0, $list);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\GET(
     *      path="/api/getAritectIdList",
     *      operationId="Module",
     *      tags={"Cms 文章/新闻"},
     *      summary="getAritectIdList 查询指定文章/新闻",
     *      description="getAritectIdList 查询指定文章/新闻",
     *      @OA\Parameter( name="id",description="文章目标id",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function getAritectIdList()
    {
        try {
            $id = $this->ci->getParam("id");

            if (isEmpty($id)) {
                return $this->ci->rsJson(609, "查询文章目标为空");
            }

            $res = $this->impl->getArticeMainIdList($id);

            return $this->ci->rsJson(0, $res);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *      path="/api/newAritec",
     *      operationId="Module",
     *      tags={"Cms 文章/新闻"},
     *      summary="newAritec 新建文章/新闻",
     *      description="newAritec 新建文章/新闻",
     *      @OA\Parameter( name="sid",description="所属id",required=true,in="path",@OA\Schema(type="Interger")),
     *      @OA\Parameter( name="title",description="文章标题",required=true,in="path",@OA\Schema(type="String")),
     *      @OA\Parameter( name="author",description="发布作者",required=true,in="path",@OA\Schema(type="String")),
     *      @OA\Parameter( name="subtitle",description="文章副标题",required=true,in="path",@OA\Schema(type="String")),
     *      @OA\Parameter( name="artice_val",description="文章内容",required=true,in="path",@OA\Schema(type="String")),
     *      @OA\Parameter( name="release_time",description="发布时间",required=true,in="path",@OA\Schema(type="Datetime")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function newAritec()
    {
        try {
            $sid = $this->ci->getParam("sid");
            $title = $this->ci->getParam("title");
            $author = $this->ci->getParam("author");
            $subtitle = $this->ci->getParam("subtitle");
            $artice_val = $this->ci->getParam("artice_val");
            $release_time = $this->ci->getParam("release_time");

            if (isEmpty($sid) || isEmpty($title) || isEmpty($artice_val) || isEmpty($release_time)) {
                return $this->ci->rsJson(404, "文章核心数据不能为空");
            }

            $res = $this->impl->newArticeMainList($sid, $title, $author, $subtitle, $artice_val, $release_time);

            return $this->ci->rsJson(0, $res);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *      path="/api/setAritec",
     *      operationId="Module",
     *      tags={"Cms 文章/新闻"},
     *      summary="setAritec 修改文章/新闻",
     *      description="setAritec 修改文章/新闻",
     *      @OA\Parameter( name="id",description="修改文章id",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="sid",description="所属文章id",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="title",description="文章标题",required=true,in="path",@OA\Schema(type="String")),
     *      @OA\Parameter( name="author",description="文章作者",required=true,in="path",@OA\Schema(type="String")),
     *      @OA\Parameter( name="subtitle",description="文章副标题",required=true,in="path",@OA\Schema(type="String")),
     *      @OA\Parameter( name="artice_val",description="文章内容",required=true,in="path",@OA\Schema(type="String")),
     *      @OA\Parameter( name="release_time",description="发布时间",required=true,in="path",@OA\Schema(type="Datetime")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function setAritec()
    {
        try {
            $id = $this->ci->getParam("id");
            $sid = $this->ci->getParam("sid");
            $title = $this->ci->getParam("title");
            $author = $this->ci->getParam("author");
            $subtitle = $this->ci->getParam("subtitle");
            $artice_val = $this->ci->getParam("artice_val");
            $release_time = $this->ci->getParam("release_time");

            if (isEmpty($id) || isEmpty($sid) || isEmpty($title) || isEmpty($artice_val) || isEmpty($release_time)) {
                return $this->ci->rsJson(404, "文章核心数据不能为空");
            }

            $res = $this->impl->setArticeMainList($id, $sid, $title, $author, $subtitle, $artice_val, $release_time);

            return $this->ci->rsJson(0, $res);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *      path="/api/delAritec",
     *      operationId="Module",
     *      tags={"Cms 文章/新闻"},
     *      summary="delAritec 删除文章/新闻",
     *      description="delAritec 删除文章/新闻",
     *      @OA\Parameter( name="id",description="修改文章id",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function delAritec()
    {
        try {
            $id = $this->ci->getParam("id");

            if (isEmpty($id)) {
                return $this->ci->rsJson(404, "删除文章不存在");
            }

            $res = $this->impl->delArtice($id);

            return $this->ci->rsJson(0, $res);
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

}
