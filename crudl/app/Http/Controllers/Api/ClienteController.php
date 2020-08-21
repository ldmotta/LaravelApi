<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Requests\StoreUpdateClientFormRequest;

class ClientController extends Controller
{
    private $cliente;

    public function __construct(Client $cliente)
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
        $customers = $this->cliente->getClients();

        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateClientFormRequest $request)
    {
        // Client::create($request->all());   
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
    public function update(StoreUpdateClientFormRequest $request, $id)
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
}
