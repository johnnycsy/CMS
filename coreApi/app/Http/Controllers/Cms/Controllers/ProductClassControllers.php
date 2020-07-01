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
     *      tags={"Cms 商品"},
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
            return $this->impl->getProductClassList();
        } catch (Exception $e) {
            return $this->ci->rsJson(609, $e->getMessage());
        }
    }

}
