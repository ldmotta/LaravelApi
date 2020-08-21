<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Requests\StoreUpdateClienteFormRequest;
use App\Repositories\ClienteRepository;

class ClienteController extends Controller
{
    private $perPage = 10;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->clienteRepository->all();

        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateClienteFormRequest $request)
    {
        $cliente = $this->clienteRepository->create($request->all());

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
        $cliente = $this->clienteRepository->findById($id);

        if (!$cliente)
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
        $cliente = $this->clienteRepository->findById($id);

        if (!$cliente)
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
        $cliente = $this->clienteRepository->findById($id);

        if (!$cliente)
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
        $cliente = $this->clienteRepository->findById($id);

        if (!$cliente)
            return response()->json(['error' => 'Not found'], 404);

        $pedidos = $cliente->pedidos()->paginate($this->perPage);

        return response()->json([
            'cliente' => $cliente,
            'pedidos' => $pedidos
        ]);
    }
}
