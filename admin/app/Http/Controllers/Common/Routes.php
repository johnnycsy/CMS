<?php
/**
 * Version   :  1.0
 * Create by :  Johnny <271802190@qq.com>
 * Copyright :  copyright (c) ooago, www.ooago.com
 * Created on:  2020/12/19 10:15 下午
 */

namespace App\Http\Controllers\Common;

use App\Http\Controllers\CMS\Controllers\WebSite;
use Illuminate\Support\Facades\Route;

class Routes
{

    public function __construct()
    {
        $this->product();
        $this->article();
        $this->siteConfiguration();
    }

    /**
     * 商品接口 Commodity interface
     */
    public function product()
    {

    }

    /**
     * 文章接口 The article interface
     */
    public function article()
    {

    }

    /**
     * 网站配置接口 Website configuration interface
     */
    public function siteConfiguration()
    {
        Route::get('/', [WebSite::class, 'hello']);
    }

}
