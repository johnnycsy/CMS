<?php
/**
 * Version   :  1.0
 * Create by :  Johnny <271802190@qq.com>
 * Copyright :  copyright (c) ooago, www.ooago.com
 * Created on:  2020/12/19 10:01 下午
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JOHNNY - CMS - System</title>
    <style>
        html, body {
            padding: 0;
            margin: 0;
        }

        .cms {
            display: block;
            width: 100%;
            height: 100%;
            text-align: center;
        }

        .cms-body {
            max-width: 60%;
            margin: 5rem auto auto auto;
            text-align: left;
        }

        @media screen and (max-width: 600px) {
            .cms-body {
                max-width: 95%;
            }
        }
    </style>
</head>
<body>
<div class="cms">
    <h1>HELLO CMS</h1>
    <h2><?= date("Y-m-d H:i:s") ?></h2>
    <div class="cms-body">
        <p>
            这是一个开源的CMS，简易的商品、文章、留言的展示功能；适合适用于企业或者商品展示，不适合商业基本使用。
        </p>
        <p>
            This is an open source CMS, simple commodity, article, message display function; Suitable for enterprise or
            commodity display, not suitable for commercial basic use.
        </p>
    </div>
</div>
</body>
</html>
