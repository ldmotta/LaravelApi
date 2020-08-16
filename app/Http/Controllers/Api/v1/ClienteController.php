<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Requests\StoreUpdateClienteFormRequest;

class ClienteController extends Controller
{
    private $cliente;
    private $perPage = 10;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = $this->cliente->getClients();

        return response()->json($clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateClienteFormRequest $request)
    {
        // Cliente::create($request->all());   
        $cliente = $this->cliente->create($request->all());

        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        $cliente = $this->cliente->find($id);

        if(!$cliente)
            return response()->json(['error' => 'Not found'], 404);
        
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateClienteFormRequest $request, $id)
    {
        $cliente = $this->cliente->find($id);

        if(!$cliente)
            return response()->json(['error' => 'Not found'], 404);

        $cliente->update($request->all());
        
        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = $this->cliente->find($id);

        if(!$cliente)
            return response()->json(['error' => 'Not found'], 404);
        
        $cliente->delete();

        return response()->json(['success' => true], 204);
    }

    /**
     * Retorna todos os pedidos de um cliente
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pedidos($id)
    {
        $cliente = $this->cliente->find($id);
        if(!$cliente)
            return response()->json(['error' => 'Not found'], 404);

        $pedidos = $cliente->pedidos()->paginate($this->perPage);

        return response()->json([
            'cliente' => $cliente,
            'pedidos' => $pedidos
        ]);
    }
}
