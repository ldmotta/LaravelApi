<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Pastel;
use App\Models\Cliente;
use App\Http\Requests\StoreUpdatePedidoFormRequest;
use App\Mail\SendMailUser;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    private $pedido;
    private $pastel;
    private $cliente;
    public function __construct(Pedido $pedido, Pastel $pastel, Cliente $cliente)
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
        $pedidos = $this->pedido->getPedidos();

        return response()->json($pedidos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePedidoFormRequest $request)
    {
        $data = $request->all();
        
        $pastel_ids = Arr::wrap(json_decode($data['pastel_id']));
        
        if(!$pastel_ids)
            return response()->json(['error' => 'Informe um número inteiro ou um array de inteiros']);

        $pasteis = [];
        $subtotal = 0;
        foreach ($pastel_ids as $pastel_id) {
            $pastel = $this->pastel->find($pastel_id);
            if( !$pastel )
                return response()->json(['error' => "pastel id {$pastel_id} não encontrado"]);
            
            if(array_key_exists($pastel->id, $pasteis)) {
                $pasteis[$pastel->id]->quantidade += 1;
                $pasteis[$pastel->id]->total = $pastel->preco * $pasteis[$pastel->id]['quantidade'];
            }else{
                $pasteis[$pastel->id] = $pastel;
                $pasteis[$pastel->id]->quantidade = 1;
                $pasteis[$pastel->id]->total = $pastel->preco;
            }
            $subtotal += (float) $pastel->preco;
        }

        $cliente = $this->cliente->find($data['cliente_id']);

        $data['pastel_id'] = json_encode($pastel_ids);
        
        $pedido = $this->pedido->create($data);

        if($pedido) 
        {
            $email_data = [
                'nome' => $cliente->nome,
                'pasteis' => $pasteis, 
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
    public function update(StoreUpdatePedidoFormRequest $request, $id)
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
