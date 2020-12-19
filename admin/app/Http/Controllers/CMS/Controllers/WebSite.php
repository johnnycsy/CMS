<?php
/**
 * Version   :  1.0
 * Create by :  Johnny <271802190@qq.com>
 * Copyright :  copyright (c) ooago, www.ooago.com
 * Created on:  2020/12/19 10:21 下午
 */

namespace App\Http\Controllers\CMS\Controllers;


use App\Http\Controllers\Controller;

class WebSite extends Controller
{

    public function __construct()
    {

    }

    public function hello(): string
    {
        return "Hello Word";
    }

}
