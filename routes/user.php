<?php

$router->get('/', function () use ($router) {
    return 'user routes';
});

// 文章
$router->group(['prefix' => 'resources/articles'], function () use ($router) {
    // 文章列表
    $router->get('/', ['uses' => 'Resources\ArticleController@index']);
});

// 海报
$router->group(['prefix' => 'resources/posters'], function () use ($router) {
    // 海报列表
    $router->get('/', ['uses' => 'Resources\PosterController@index']);
    // 海报详情
    $router->get('{id}', ['uses' => 'Resources\PosterController@show']);
});

// 商品
$router->group(['prefix' => 'resources/products'], function () use ($router) {
    // 商品列表
    $router->get('/', ['uses' => 'Resources\ProductController@index']);
});

// 传播
$router->group(['prefix' => 'spreads'], function () use ($router) {
    // 我的传播
    $router->get('/', ['uses' => 'SpreadController@index']);
    // 创建传播
    $router->post('/', ['uses' => 'SpreadController@store']);
    // 传播详情
    $router->get('{id}', ['uses' => 'SpreadController@show']);
    // 删除传播
    $router->delete('{id}', ['uses' => 'SpreadController@destroy']);
});
