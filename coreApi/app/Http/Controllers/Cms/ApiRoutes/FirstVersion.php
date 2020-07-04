<?php
/**
 * Created by PhpStorm PHP Version 7.3.9
 * User：johnn
 * Date：2020/5/22
 * Time：9:27 下午
 * WebSite：www.ooago.com
 * Developer：Johnny
 * Project Name：johnnyCms
 */


namespace App\Http\Controllers\Cms\ApiRoutes;


use Illuminate\Support\Facades\Route;

class FirstVersion
{
    private $CMS = "Cms\Controllers\\";

    public function __construct()
    {
        $this->apiList();
    }

    public function apiList()
    {
        Route::get("/", $this->CMS . "SystemControllers@helloWord");
        // Aritec
        Route::get("/getAritecList", $this->CMS . "ArticeMainControllers@getAritecList");
        Route::get("/getAritectIdList", $this->CMS . "ArticeMainControllers@getAritectIdList");
        Route::get("/newAritec", $this->CMS . "ArticeMainControllers@newAritec");
        Route::get("/setAritec", $this->CMS . "ArticeMainControllers@setAritec");
        Route::get("/delAritec", $this->CMS . "ArticeMainControllers@delAritec");

        Route::get("/getArticeClass", $this->CMS . "ArticeClassControllers@getArticeClass");
        Route::get("/newArticeClass", $this->CMS . "ArticeClassControllers@newArticeClass");
        Route::get("/setArticeClass", $this->CMS . "ArticeClassControllers@setArticeClass");
        Route::get("/delArticeClass", $this->CMS . "ArticeClassControllers@delArticeClass");
        // System
        Route::get("/setSystem", $this->CMS . "SystemControllers@setSystem");
        // product class
        Route::get("/getProductClass", $this->CMS . "ProductClassControllers@getProductClass");
        Route::get("/newProductClass", $this->CMS . "ProductClassControllers@newProductClass");
        Route::get("/setProductClass", $this->CMS . "ProductClassControllers@setProductClass");
        Route::get("/delProductClass", $this->CMS . "ProductClassControllers@delProductClass");
        /* product */
        Route::get("/getProduct", $this->CMS . "ProductControllers@getProduct");
        Route::get("/newProduct", $this->CMS . "ProductControllers@newProduct");
        Route::get("/setProduct", $this->CMS . "ProductControllers@setProduct");
        Route::get("/delProduct", $this->CMS . "ProductControllers@delProduct");

    }

}
