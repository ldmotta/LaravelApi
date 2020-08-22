<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Requests\StoreUpdateOrderFormRequest;

class OrderController extends Controller
{
    private $pedido;
    public function __construct(Order $pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = $this->pedido->getOrders();

        return response()->json($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateOrderFormRequest $request)
    {
        $pedido = $this->pedido->create($request->all());

        return response()->json($pedido, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        $pedido = $this->pedido->find($id);

        if(!$pedido)
            return response()->json(['error' => 'Not found'], 404);
        
        return response()->json($pedido);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateOrderFormRequest $request, $id)
    {
        $pedido = $this->pedido->find($id);

        if(!$pedido)
            return response()->json(['error' => 'Not found'], 404);

        $pedido->update($request->all());
        
        return response()->json($pedido);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = $this->pedido->find($id);

        if(!$pedido)
            return response()->json(['error' => 'Not found'], 404);
        
        $pedido->delete();

        return response()->json(['success' => true], 204);
    }
}
