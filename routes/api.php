<?php

Route::group(['prefix' => 'v2', 'namespace' => 'Api\v2'], function () {
    Route::apiResource('customers', 'CustomerController');
    Route::apiResource('products', 'ProductController');
    Route::apiResource('orders', 'OrderController');
    Route::get('customers/{id}/order', 'CustomerController@order');
    Route::get('customers/{id}', 'CustomerController@mostrar');
});
