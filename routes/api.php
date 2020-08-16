<?php

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {
    Route::get('clientes/{id}/pedidos', 'ClienteController@pedidos');
    Route::apiResource('clientes', 'ClienteController');
    Route::apiResource('pasteis', 'PastelController');
    Route::apiResource('pedidos', 'PedidoController');
});

