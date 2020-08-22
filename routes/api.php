<?php

Route::group(['prefix' => 'v2', 'namespace' => 'Api\v2'], function () {
    Route::apiResource('customers', 'ClientController');
    Route::apiResource('products', 'ProductController');
    Route::apiResource('order', 'OrderController');
    Route::get('customers/{id}/order', 'ClientController@order');
    Route::get('cliente/{id}', 'ClientController@mostrar');
});
