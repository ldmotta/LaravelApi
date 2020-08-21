<?php

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {
    Route::get('customers/{id}/order', 'ClienteController@order');
    Route::apiResource('customers', 'ClienteController');
    Route::apiResource('products', 'PastelController');
    Route::apiResource('order', 'PedidoController');
    Route::get('cliente/{id}', 'ClienteController@mostrar');
});


Route::group(['prefix' => 'v2', 'namespace' => 'Api\v2'], function () {
    Route::apiResource('customers', 'ClienteController');
    Route::apiResource('products', 'PastelController');
    Route::apiResource('order', 'PedidoController');
    Route::get('customers/{id}/order', 'ClienteController@order');
    Route::get('cliente/{id}', 'ClienteController@mostrar');
});

