<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\StoreUpdateCustomerFormRequest;
use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    private $perPage = 10;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customerRepository->all();

        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCustomerFormRequest $request)
    {
        $cliente = $this->customerRepository->create($request->all());

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
        $cliente = $this->customerRepository->findById($id);

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
    public function update(StoreUpdateCustomerFormRequest $request, $id)
    {
        $cliente = $this->customerRepository->findById($id);

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
        $cliente = $this->customerRepository->findById($id);

        if (!$cliente)
            return response()->json(['error' => 'Not found'], 404);
        
        $cliente->delete();

        return response()->json(['success' => true], 204);
    }

    /**
     * Retorna todos os order de um cliente
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function order($id)
    {
        $cliente = $this->customerRepository->findById($id);

        if (!$cliente)
            return response()->json(['error' => 'Not found'], 404);

        $order = $cliente->order()->paginate($this->perPage);

        return response()->json([
            'cliente' => $cliente,
            'order' => $order
        ]);
    }
}
