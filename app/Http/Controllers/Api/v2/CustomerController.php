<?php
namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\StoreUpdateCustomerFormRequest;
use App\Repositories\Repository;

class CustomerController extends Controller
{
    private $perPage = 10;
    protected $model;

    public function __construct(Customer $customer)
    {
        $this->model = new Repository($customer);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->model->all();

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
        $customer = $this->model->create($request->all());

        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        $customer = $this->model->find($id);

        if (!$customer) {
            return response()->json(['error' => 'Not found'], 404);
        }
        
        return response()->json($customer);
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
        $customer = $this->model->find($id);

        if (!$customer) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $customer = $this->model->update($request->all(), $id);
        
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = $this->model->find($id);

        if (!$customer) {
            return response()->json(['error' => 'Not found'], 404);
        }
        
        $this->model->delete($customer);

        return response()->json(['success' => true], 204);
    }

    /**
     * Retorna todos os pedidos de um customer
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function order($id)
    {
        $customer = $this->model->find($id);

        if (!$customer)
            return response()->json(['error' => 'Not found'], 404);

        $order = $customer->order()->paginate($this->perPage);

        return response()->json([
            'customer' => $customer,
            'order' => $order
        ]);
    }
}
