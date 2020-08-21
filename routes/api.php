<?php

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {
    Route::get('customers/{id}/pedidos', 'ClienteController@pedidos');
    Route::apiResource('customers', 'ClienteController');
    Route::apiResource('products', 'PastelController');
    Route::apiResource('pedidos', 'PedidoController');
    Route::get('cliente/{id}', 'ClienteController@mostrar');
});


Route::group(['prefix' => 'v2', 'namespace' => 'Api\v2'], function () {
    Route::apiResource('customers', 'ClienteController');
    Route::apiResource('products', 'PastelController');
    Route::apiResource('pedidos', 'PedidoController');
    Route::get('customers/{id}/pedidos', 'ClienteController@pedidos');
    Route::get('cliente/{id}', 'ClienteController@mostrar');
});

