<?php

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {
    Route::get('customers/{id}/order', 'ClientController@order');
    Route::apiResource('customers', 'ClientController');
    Route::apiResource('products', 'PastelController');
    Route::apiResource('order', 'PedidoController');
    Route::get('cliente/{id}', 'ClientController@mostrar');
});


Route::group(['prefix' => 'v2', 'namespace' => 'Api\v2'], function () {
    Route::apiResource('customers', 'ClientController');
    Route::apiResource('products', 'PastelController');
    Route::apiResource('order', 'PedidoController');
    Route::get('customers/{id}/order', 'ClientController@order');
    Route::get('cliente/{id}', 'ClientController@mostrar');
});

