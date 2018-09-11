<?php

// 门店
$router->group(['prefix' => 'stores'], function () use ($router) {
    // 门店列表
    $router->get('/', ['uses' => 'StoreController@index']);
    // 新增门店
    $router->post('/', ['uses' => 'StoreController@store']);
    // 编辑任务
    $router->put('{id}', ['uses' => 'StoreController@update']);
    // 删除任务
    $router->delete('{id}', ['uses' => 'StoreController@destroy']);
});

// 店员
$router->group(['prefix' => 'sellers'], function () use ($router) {
    // 店员列表
    $router->get('/', ['uses' => 'SellerController@index']);
    // 店员详情
    $router->get('{id}', ['uses' => 'SellerController@show']);
    // 新增店员
    $router->post('/', ['uses' => 'SellerController@store']);
    // 编辑店员
    $router->put('{id}', ['uses' => 'SellerController@update']);
    // 删除店员
    $router->delete('{id}', ['uses' => 'SellerController@destroy']);
});

// 任务
$router->group(['prefix' => 'tasks'], function () use ($router) {
    // 任务列表
    $router->get('/', ['uses' => 'TaskController@index']);
    // 任务详情
    $router->get('{id}', ['uses' => 'TaskController@show']);
    // 预览任务
    $router->post('preview', ['uses' => 'TaskController@preview']);
    // 保存任务
    $router->post('/', ['uses' => 'TaskController@store']);
    // 编辑任务
    $router->put('{id}', ['uses' => 'TaskController@update']);
    // 删除任务
    $router->delete('{id}', ['uses' => 'TaskController@destroy']);
});

// 文章
$router->group(['prefix' => 'resources/articles'], function () use ($router) {
    // 文章列表
    $router->get('/', ['uses' => 'Resources\ArticleController@index']);
    // 新增文章
    $router->post('/', ['uses' => 'Resources\ArticleController@store']);
    // 文章详情
    $router->get('{id}', ['uses' => 'Resources\ArticleController@show']);
    // 修改文章
    $router->put('{id}', ['uses' => 'Resources\ArticleController@update']);
    // 删除文章
    $router->delete('{id}', ['uses' => 'Resources\ArticleController@destroy']);
});

// 海报
$router->group(['prefix' => 'resources/posters'], function () use ($router) {
    // 海报列表
    $router->get('/', ['uses' => 'Resources\PosterController@index']);
    // 新增海报
    $router->post('/', ['uses' => 'Resources\PosterController@store']);
    // 海报详情
    $router->get('{id}', ['uses' => 'Resources\PosterController@show']);
    // 修改海报
    $router->put('{id}', ['uses' => 'Resources\PosterController@update']);
    // 删除海报
    $router->delete('{id}', ['uses' => 'Resources\PosterController@destroy']);
});

// 商品
$router->group(['prefix' => 'resources/products'], function () use ($router) {
    // 商品列表
    $router->get('/', ['uses' => 'Resources\ProductController@index']);
    // 已添加商品的id列表
    $router->get('joined', ['uses' => 'Resources\ProductController@joined']);
    // 选取商品
    $router->post('choose', ['uses' => 'Resources\ProductController@choose']);
    // 删除商品
    $router->delete('{id}', ['uses' => 'Resources\ProductController@destroy']);
});
