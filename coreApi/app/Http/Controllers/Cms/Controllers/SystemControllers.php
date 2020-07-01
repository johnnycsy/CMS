<?php
/**
 * Created by PhpStorm PHP Version 7.3.9
 * User：johnn
 * Date：2020/5/19
 * Time：12:02 上午
 * WebSite：www.ooago.com
 * Developer：Johnny
 * Project Name：johnnyCms
 */


namespace App\Http\Controllers\Cms\Controllers;


use App\Http\Controllers\Cms\Service\Impl\SystemServiceImpl;
use App\Http\Controllers\Common\ConfigInc;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class SystemControllers extends Controller
{
    /**
     * @var ConfigInc
     */
    private $ci;

    /**
     * @var SystemServiceImpl
     */
    private $impl;

    /**
     * SystemControllers constructor.
     */
    public function __construct()
    {
        $this->ci = new ConfigInc();
        $this->impl = new SystemServiceImpl();
    }

    /**
     * @return false|string
     */
    public function helloWord()
    {
        return $this->ci->rsJson(0, "Hello Word");
    }

    /**
     * @OA\POST(
     *      path="/api/setSystem",
     *      operationId="Module",
     *      tags={"Cms 系统信息"},
     *      summary="setSystem 设置系统信息",
     *      description="setSystem 设置系统信息",
     *      @OA\Parameter( name="web_name",description="网站名称",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="web_host",description="网站地址",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="web_seo",description="SEO短语，使用英文逗号分割",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="web_title",description="网站标题",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="web_describe",description="网站详情",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="web_qq",description="站长QQ",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="web_wechat",description="站长微信",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="web_email",description="站长邮箱",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Parameter( name="web_contact",description="站长内容",required=true,in="path",@OA\Schema(type="Integer")),
     *      @OA\Response( response=200,description="successful operation")
     *     )
     *
     * Returns list of projects
     */
    public function setSystem()
    {
        try {
            $web_name = $this->ci->getParam("web_name");
            $web_host = $this->ci->getParam("web_host");
            $web_seo = $this->ci->getParam("web_seo");
            $web_title = $this->ci->getParam("web_title");
            $web_describe = $this->ci->getParam("web_describe");
            $web_qq = $this->ci->getParam("web_qq");
            $web_wechat = $this->ci->getParam("web_wechat");
            $web_email = $this->ci->getParam("web_email");
            $web_contact = $this->ci->getParam("web_contact");

            $list = $this->impl->getSystemList();

            if (count($list) > 0) {
                $this->impl->setSystem($web_name, $web_host, $web_seo, $web_title, $web_describe, $web_qq, $web_wechat, $web_email, $web_contact);
            } else {
                $this->impl->newSystem($web_name, $web_host, $web_seo, $web_title, $web_describe, $web_qq, $web_wechat, $web_email, $web_contact);
            }

            return $this->ci->rsJson(0, $this->impl->getSystemList());
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

}
