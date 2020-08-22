<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;
use App\Http\Requests\StoreUpdateOrderFormRequest;
use App\Mail\SendMailUser;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    private $pedido;
    private $pastel;
    private $cliente;
    public function __construct(Order $pedido, Product $pastel, Client $cliente)
    {
        $this->pedido = $pedido;
        $this->pastel = $pastel;
        $this->cliente = $cliente;
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
        $data = $request->all();
        
        $product_ids = Arr::wrap(json_decode($data['product_id']));
        
        if(!$product_ids)
            return response()->json(['error' => 'Informe um número inteiro ou um array de inteiros']);

        $products = [];
        $subtotal = 0;
        foreach ($product_ids as $product_id) {
            $pastel = $this->pastel->find($product_id);
            if( !$pastel )
                return response()->json(['error' => "pastel id {$product_id} não encontrado"]);
            
            if(array_key_exists($pastel->id, $products)) {
                $products[$pastel->id]->quantidade += 1;
                $products[$pastel->id]->total = $pastel->price * $products[$pastel->id]['quantidade'];
            }else{
                $products[$pastel->id] = $pastel;
                $products[$pastel->id]->quantidade = 1;
                $products[$pastel->id]->total = $pastel->price;
            }
            
            $subtotal += (float) $pastel->price;
        }

        $cliente = $this->cliente->find($data['client_id']);

        $data['product_id'] = json_encode($product_ids);
        
        $pedido = $this->pedido->create($data);

        if($pedido) 
        {
            $email_data = [
                'name' => $cliente->name,
                'products' => $products, 
                'subtotal' =>  $subtotal
            ];
    
            Mail::to($cliente->email)->send(new SendMailUser($email_data));
        }

        return response()->json(['success' => $pedido], 201);
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
